<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\user_loan_profile;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class LoanProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Pending , Rejected & aproved Profile Without Rejected
    // 2=Pendin
    // 3=Aproved
    // 4=Rejected
    // re_submit_status=1=Temporary Rejected
    public function allMemberList()
    {
        $status = ["2","3","4"];
        try {
            $data = DB::table('user_loan_profiles')->whereNull('deleted_at')->whereIn("status",$status)->latest()->get()->take(3);
            return view('admin.loan-profile.all-member-list', ['data' => $data]);
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }



    public function allCloseRequestMemberList()
    {
        try {
            $data = DB::table('user_loan_profiles')->where("loan_close_reason", '2')->whereNull('deleted_at')->latest()->get();
            return view('admin.loan-profile.all-closerequest-member-list', ['data' => $data]);
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }


    public function CloseRequestMemberPost($id)
    {
        user_loan_profile::where('id',$id)->update([
            "loan_close_reason" => "1"
        ]);
        return back()->with('success', 'Loan Closed Successfull');
    }



    // Filter Profile List For Admin
    // 2=Pendin
    // 3=Aproved
    // 4=Rejected
    // re_submit_status=1=Temporary Rejected
    public function allMemberListByStatus(Request $request){
        $status = ["1","2","3","4"];
        if ($request->loanstats == "4") {
            $Rejected_loan_profile = user_loan_profile::where('re_submit_status','1')->whereIn("status",$status)->whereNull('deleted_at')->orderBy('name', 'asc')->get();
            return view('admin.loan-profile.all-member-list', [
                'data' => $Rejected_loan_profile,
                'selected_type' => $request->loanstats
                ]
            );
        }else{
            $pending_loan_profile = user_loan_profile::where('status', $request->loanstats)->whereNull('deleted_at')->whereIn("status",$status)->orderBy('name', 'asc')->get();
            return view('admin.loan-profile.all-member-list', [
                'data' => $pending_loan_profile,
                'selected_type' => $request->loanstats
                ]
            );
        }

    }


    /*--------Single Loan Profile View For Admin---------*/
    public function MemberView($id)
    {
        $id = base64_decode($id);
        try {
            $data = DB::table('user_loan_profiles')->where('id', $id)->first();
            return view('admin.loan-profile.member-view-profile', compact('data'));
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }


    /*--------Approved Loan Profile By Super Admin-----------*/
    public function LoanApproveByAdmin($id)
    {

        try {
            $data = DB::table('user_loan_profiles')->where('id', $id)->update([
                'status'     => '3',
                'admin_check_date'     => Carbon::now(),
            ]);



            $loaninfo = DB::table('user_loan_profiles')->where('id', $id)->first();
            if ($loaninfo) {
                if ($loaninfo->mobile) {

                    $message = urlencode("Congratulations! Dear BFSS-Ltd. Customer. Your loan successfully approved. Loan amount BDT ".$loaninfo->loan_amount."৳ as on ". Carbon::now()->format('d-M, Y, h:m a').". For details please visit your offices.");

                    $template = settings()->sms2;
                    if($template != "" || $template != null){
                        $template = str_replace("{amount}", $loaninfo->loan_amount, $template);
                        $template = str_replace("{date}", Carbon::now()->format('d-m-Y h:ia'), $template);
                        $message = $template;
                        $message = urlencode($message);
                    }

                    $reciver_mobile = $loaninfo->mobile;
                    // $reciver_mobile = "01617253586";

                    $username = "8809601004416";

                    $smsresult = 1;
                    if(settings()->sms2_is_enable == 1){
                        $smsresult = file_get_contents("https://bulksmsbd.net/api/smsapi?api_key=GjKDTrfYuQrhlDA0IOy1&type=text&number=$reciver_mobile&senderid=$username&message=$message");
                    }

                    if ($smsresult) {
                        return back()->with('success', 'Loan Submitted Successfully This User');
                    } else {
                        return back()->with('error', 'Something Went Wrong');
                    }
                }
            }

            return back()->with('success', 'Loan Approve Successfull');
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }






    /*--------Approved Loan Profile By Super Admin-----------*/
    public function MemberLoanRejectedByAdmin(Request $request,$id)
    {

        try {
            $data = DB::table('user_loan_profiles')->where('id', $id)->update([
                're_submit_status'     => '1',
                'admin_check_date'     => Carbon::now(),
                'super_admin_rejected_reason'     => $request->rejected_reason,

            ]);


            return back()->with('success', 'Loan Rejected Successfull');
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }




    // Loan Profile Edit By Super Admin
    public function loanmember_EditByAdmin($id)
    {
        $id = base64_decode($id);
        $data = DB::table('user_loan_profiles')->where('id', $id)->first();
        return view('admin.loan-profile.admin-mamber-edit', compact('data'));
    }


    public function loanmember_EditByAdminPost(Request $request, $id)
    {

        $totallav = $request->loan_amount * $request->intrestRate/100;
        $totaLamountWithLav = $totallav + $request->loan_amount;
        $TotalIntrestAmountForEveryInstallment = $totaLamountWithLav/$request->loanInstallment;


        try {
            $loan = [];
            $loan['chk_img']   = $request->chk_img;
            $loan['name']                        = $request->name;
            $loan['mobile']                      = $request->mobile;
            $loan['fathers_name']                = $request->fathers_name;
            $loan['mothers_name']                = $request->mothers_name;
            $loan['loan_owner_Occupation']                = $request->loan_owner_Occupation;
            $loan['loan_owner_card_no']          = $request->loan_owner_card_no;
            $loan['loan_amount']                 = $request->loan_amount;
            $loan['intrestRate']                 = $request->intrestRate;
            $loan['loanInstallment']                 = $request->loanInstallment;
            $loan['installmentType']                 = $request->installmentType;
            $loan['TotalIntrestAmountForEveryInstallment']            = $TotalIntrestAmountForEveryInstallment;
            $loan['day']                         = $request->day;
            $loan['month']                       = $request->month;
            $loan['year']                        = $request->year;
            $loan['loan_owner_zila']             = $request->loan_owner_zila;
            $loan['loan_owner_upazila']          = $request->loan_owner_upazila;
            $loan['loan_owner_union']            = $request->loan_owner_union;
            $loan['loan_owner_pincode']          = $request->loan_owner_pincode;
            $loan['loan_owner_gram']             = $request->loan_owner_gram;
            $loan['loan_owner_branch']           = $request->loan_owner_branch;
            $loan['relationgranter']                 = $request->relationgranter;
            $loan['granter_name']                = $request->granter_name;
            $loan['granter_mobile']              = $request->granter_mobile;
            $loan['granter_id_card_no']          = $request->granter_id_card_no;
            $loan['granter_fathers_name']        = $request->granter_fathers_name;
            $loan['granter_mothers_name']        = $request->granter_mothers_name;
            $loan['granterOccupation']          = $request->granterOccupation;
            $loan['granter_day']                 = $request->granter_day;
            $loan['granter_month']               = $request->granter_month;
            $loan['granter_year']                = $request->granter_year;
            $loan['granter_zila']                = $request->granter_zila;
            $loan['granter_upazila']                = $request->granter_upazila;
            $loan['granter_union']                = $request->granter_union;
            $loan['granter_pincode']             = $request->granter_pincode;
            $loan['granter_gram']                = $request->granter_gram;
            $loan['relationgranter2']             = $request->relationgranter2;
            $loan['granter_2_name']                            = $request->granter_2_name;
            $loan['granter_2_mobile']                            = $request->granter_2_mobile;
            $loan['granter_2_id_card_no']                            = $request->granter_2_id_card_no;
            $loan['granter_2_fathers_name']                            = $request->granter_2_fathers_name;
            $loan['granter_2_mothers_name']                            = $request->granter_2_mothers_name;
            $loan['granter2Occupation']                            = $request->granter2Occupation;
            $loan['granter_2_day']                            = $request->granter_2_day;
            $loan['granter_2_month']                            = $request->granter_2_month;
            $loan['granter_2_year']                            = $request->granter_2_year;
            $loan['granter_2_zila']                            = $request->granter_2_zila;
            $loan['granter_2_upazila']                            = $request->granter_2_upazila;
            $loan['granter_2_union']                            = $request->granter_2_union;
            $loan['granter_2_pincode']                            = $request->granter_2_pincode;
            $loan['granter_2_gram']                            = $request->granter_2_gram;



            if ($request->hasFile('loan_owner_image')) {
                $image = $request->file('loan_owner_image');
                $ext = $image->extension();
                $file = rand(0000, 9999) . '.' . $ext;
                $image->move('uploads/loan_profile', $file);
                $loan['loan_owner_image'] = $file;
            }
            if ($request->hasFile('loan_owner_id_card')) {
                $image = $request->file('loan_owner_id_card');
                $ext = $image->extension();
                $file = rand(0000, 9999) . '.' . $ext;
                $image->move('uploads/loan_profile', $file);
                $loan['loan_owner_id_card'] = $file;
            }
            if ($request->hasFile('granter_image')) {
                $image = $request->file('granter_image');
                $ext = $image->extension();
                $file = rand(0000, 9999) . '.' . $ext;
                $image->move('uploads/loan_profile', $file);
                $loan['granter_image'] = $file;
            }
            if ($request->hasFile('granter__2_image')) {
                $image = $request->file('granter__2_image');
                $ext = $image->extension();
                $file = rand(0000, 9999) . '.' . $ext;
                $image->move('uploads/loan_profile', $file);
                $loan['granter__2_image'] = $file;
            }
            if ($request->hasFile('granter_id_photo')) {
                $image = $request->file('granter_id_photo');
                $ext = $image->extension();
                $file = rand(0000, 9999) . '.' . $ext;
                $image->move('uploads/loan_profile', $file);
                $loan['granter_id_photo'] = $file;
            }
            if ($request->hasFile('granter2_id_photo')) {
                $image = $request->file('granter2_id_photo');
                $ext = $image->extension();
                $file = rand(0000, 9999) . '.' . $ext;
                $image->move('uploads/loan_profile', $file);
                $loan['granter2_id_photo'] = $file;
            }


            $data = DB::table('user_loan_profiles')->where('id', $id)->update($loan);
            return back()->with('success', 'User Loan Profile Updated Successfully');
        } catch (Exception $th) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }




    /*--------Member Delete----------*/
    public function MemberDeleteByAdmin($id)
    {
        try {
            $data = DB::table('user_loan_profiles')->where('id', $id)->update(['deleted_at' => Carbon::now()]);
            return back()->with('success', 'Member Deleted Successfull');
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }



    // END==============================================================













































    // Requested Fun
    // public function allEditRequestMember()
    // {
    //     try {
    //         $data = DB::table('lon_edit_requests')->whereNull('deleted_at')->latest()->get();
    //         return view('admin.all-edit-request-member-list', ['data' => $data]);
    //     } catch (Exception $e) {
    //         return back()->with('error', 'Oops! Something Went Wrong');
    //     }
    // }

    // public function loanmember_EditRequestView($id)
    // {
    //     DB::table('lon_edit_requests')->whereNull('deleted_at')->where('seenstatus', 'unseen')->where('id', $id)->update([
    //         'seenstatus' => 'seen'
    //     ]);


    //     $data = DB::table('lon_edit_requests')->where('id', $id)->first();
    //     return view('admin.view-member-request-edit-profile', compact('data'));
    // }



    // public function loanmember_EditRequestAprove($id)
    // {

    //     $edit_data = DB::table('lon_edit_requests')->where('id', $id)->first();


    //     try {
    //         $loan = [];
    //         $loan['chk_img']                     = $edit_data->chk_img;
    //         $loan['name']            = $edit_data->name;
    //         $loan['mobile']          = $edit_data->mobile;
    //         $loan['fathers_name']        = $edit_data->fathers_name;
    //         $loan['mothers_name']               = $edit_data->mothers_name;
    //         $loan['loan_owner_Occupation']             = $edit_data->loan_owner_Occupation;
    //         $loan['loan_owner_card_no']             = $edit_data->loan_owner_card_no;
    //         $loan['loan_amount']             = $edit_data->loan_amount;
    //         $loan['intrestRate']                = $edit_data->intrestRate;
    //         $loan['loanInstallment']                = $edit_data->loanInstallment;
    //         $loan['installmentType']          = $edit_data->installmentType;
    //         $loan['TotalIntrestAmountForEveryInstallment']          = $edit_data->TotalIntrestAmountForEveryInstallment;
    //         $loan['day']          = $edit_data->day;
    //         $loan['month']          = $edit_data->month;
    //         $loan['year']             = $edit_data->year;
    //         $loan['loan_owner_zila']          = $edit_data->loan_owner_zila;
    //         $loan['loan_owner_upazila']            = $edit_data->loan_owner_upazila;
    //         $loan['loan_owner_union']          = $edit_data->loan_owner_union;
    //         $loan['loan_owner_pincode']             = $edit_data->loan_owner_pincode;
    //         $loan['loan_owner_gram']           = $edit_data->loan_owner_gram;
    //         $loan['loan_owner_branch']                 = $edit_data->loan_owner_branch;
    //         $loan['relationgranter']                = $edit_data->relationgranter;
    //         $loan['granter_name']                 = $edit_data->granter_name;
    //         $loan['granter_mobile']               = $edit_data->granter_mobile;
    //         $loan['granter_id_card_no']                = $edit_data->granter_id_card_no;
    //         $loan['granter_fathers_name']              = $edit_data->granter_fathers_name;
    //         $loan['granter_mothers_name']        = $edit_data->granter_mothers_name;
    //         $loan['granterOccupation']        = $edit_data->granterOccupation;
    //         $loan['granter_day']        = $edit_data->granter_day;
    //         $loan['granter_month']          = $edit_data->granter_month;
    //         $loan['granter_year']                = $edit_data->granter_year;
    //         $loan['granter_zila']             = $edit_data->granter_zila;
    //         $loan['granter_upazila']               = $edit_data->granter_upazila;
    //         $loan['granter_union']             = $edit_data->granter_union;
    //         $loan['granter_pincode']              = $edit_data->granter_pincode;
    //         $loan['granter_gram']            = $edit_data->granter_gram;
    //         $loan['relationgranter2']      = $edit_data->relationgranter2;
    //         $loan['granter_2_name']      = $edit_data->granter_2_name;
    //         $loan['granter_2_mobile']        = $edit_data->granter_2_mobile;
    //         $loan['granter_2_id_card_no']               = $edit_data->granter_2_id_card_no;
    //         $loan['granter_2_fathers_name']             = $edit_data->granter_2_fathers_name;
    //         $loan['granter_2_mothers_name']              = $edit_data->granter_2_mothers_name;
    //         $loan['granter2Occupation']              = $edit_data->granter2Occupation;
    //         $loan['granter_2_day']           = $edit_data->granter_2_day;
    //         $loan['granter_2_month']             = $edit_data->granter_2_month;
    //         $loan['granter_2_year']           = $edit_data->granter_2_year;
    //         $loan['granter_2_zila']              = $edit_data->granter_2_zila;
    //         $loan['granter_2_upazila']            = $edit_data->granter_2_upazila;
    //         $loan['granter_2_union']                = $edit_data->granter_2_union;
    //         $loan['granter_2_pincode']                = $edit_data->granter_2_pincode;
    //         $loan['granter_2_gram']                = $edit_data->granter_2_gram;

    //         $loan['loan_owner_image'] = $edit_data->loan_owner_image;
    //         $loan['loan_owner_id_card'] = $edit_data->loan_owner_id_card;
    //         $loan['granter_image'] = $edit_data->granter_image;
    //         $loan['granter__2_image'] = $edit_data->granter__2_image;
    //         $loan['granter_id_photo'] = $edit_data->granter_id_photo;
    //         $loan['granter2_id_photo'] = $edit_data->granter2_id_photo;



    //         DB::table('user_loan_profiles')->where('id', $edit_data->loan_id)->update($loan);

    //         DB::table('lon_edit_requests')->where('id', $id)->update(['deleted_at' => Carbon::now()]);


    //         DB::table('notifications')->insert([
    //             'user_id' => Auth::user()->id,
    //             'n_for' => 'manager',
    //             'n_type' => "Aproved Edit Request",
    //             'n_type_id' => '1',
    //         ]);

    //         return redirect('admin/dashboard/member-edit/list')->with('success', 'User Loan Profile Updated Successfully');

    //     } catch (Exception $th) {
    //         return redirect('admin/dashboard/member-edit/list')->with('error', 'Oops! Something Went Wrong');
    //     }
    // }

    // public function loanmember_EditRequestRejected($id){
    //     DB::table('lon_edit_requests')->where('id', $id)->update(['deleted_at' => Carbon::now()]);
    //     // DB::table('notifications')->insert([
    //     //     'user_id' => Auth::user()->id,
    //     //     'n_for' => 'manager',
    //     //     'n_type' => "Rejected Edit Request",
    //     //     'n_type_id' => '1',
    //     // ]);

    //     return redirect('admin/dashboard/member-edit/list')->with('error', 'User Loan Profile Edit Request Delete Successfully');

    // }

    // public function MemberLoanRejecteds(Request $request,$id)
    // {
    //     try {
    //         $data = DB::table('user_loan_profiles')->where('id', $id)->update([
    //             'status'     => '3',
    //             'rejected_reason'   => $request->rejected_reason,
    //         ]);
    //         DB::table('notifications')->insert([
    //             'user_id' => Auth::user()->id,
    //             'n_for' => 'loanOfficer',
    //             'n_type' => "Rejected Form",
    //             'n_type_id' => $id,
    //         ]);

    //         DB::table('notifications')->insert([
    //             'user_id' => Auth::user()->id,
    //             'n_for' => 'manager',
    //             'n_type' => "Rejected Form",
    //             'n_type_id' => $id,
    //         ]);

    //         return back()->with('success', 'Loan Rejected Successfull');
    //     } catch (Exception $e) {
    //         return back()->with('error', 'Oops! Something Went Wrong');
    //     }
    // }
}
