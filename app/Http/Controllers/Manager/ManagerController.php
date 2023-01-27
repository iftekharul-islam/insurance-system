<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\LonEditRequest;
use App\Models\manager_profile;
use App\Models\officer_profile;
use App\Models\RecivedLoan;
use App\Models\User;
use App\Models\user_loan_profile;
use App\Models\UserLog;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ManagerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $manager_id = Auth::user()->id;
        $data = DB::table('users')->where('manager_id', $manager_id)->get();
        return view('manager.create-loan-officer', ['data' => $data]);
    }







    public function create_loan_officer(Request $request)
    {

        $request->validate(
            [
                'name'            => 'required',
                'email'           => 'required||string||max:255||unique:users',
                'phone'           => 'required',
                'password'        => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            ],
            [
                'email.required' => 'User Name Fild id Required',
                'email.unique'   => 'User Name Must be Unique',
            ]
        );


        $manager_id = Auth::user()->id;
        $manager_branch = Auth::user()->manager_branch;
        $data = DB::table('users')->insert([
            'name'              =>  $request->name,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'manager_branch'    => $manager_branch,
            'manager_id'        => $manager_id,
            'password'          => Hash::make($request->password),
            'is_admin'          => $request->is_admin
        ]);

        return back()->with('success', 'Loan Officer Created Successully');
    }



    public function loan_officer_edit($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return view('manager.loan-officer-edit', compact('data'));
    }

    public function loan_officer_update(Request $request, $id)
    {
        $request->validate(
            [
                'name'            => 'required',
                'email'           => 'required||string||max:255||unique:users,email,'.$id,
                'phone'           => 'required',
            ],
            [
                'email.required' => 'User Name Fild id Required',
                'email.unique'   => 'User Name Must be Unique',
            ]
        );

        if (!empty($request->password)) {
            $request->validate(
                [
                    'password'        => [Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
                ]
            );
        }

        $manager_branch = Auth::user()->manager_branch;
        $data = DB::table('users')->where('id', $id)->update([
            'name'   =>  $request->name,
            'email'        => $request->email,
            'phone'     => $request->phone,
            'manager_branch'    => $manager_branch,
            'password'    => Hash::make($request->password),
            'is_admin'    => $request->is_admin
        ]);
        return back()->with('success', 'Loan Officer Updated Successully');
    }




    /*-------Loan Member List--------*/
    public function loanMemberList()
    {

        $manager_id = Auth::user()->id;
        $status = ["0","1","2","3"];
        try {
            $data = DB::table('user_loan_profiles')->where('manager_id', $manager_id)->whereNull('deleted_at')->whereIn("status", $status)->latest()->get();
            return view('manager.loan-member-list', ['data' => $data]);
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }




    public function MemberListByStatusManager(Request $request){

        $status = ["0"];
        if ($request->loanstats == "4") {
            $Rejected_loan_profile = user_loan_profile::where('re_submit_status','1')->whereIn("status",$status)->whereNull('deleted_at')->orderBy('name', 'asc')->get();
            return view('manager.loan-member-list', [
                'data' => $Rejected_loan_profile,
                'selected_type' => $request->loanstats
                ]
            );
        }else{
            $pending_loan_profile = user_loan_profile::where('status', $request->loanstats)->whereNull('re_submit_status')->orderBy('name', 'asc')->get();
            return view('manager.loan-member-list', [
                'data' => $pending_loan_profile,
                'selected_type' => $request->loanstats
                ]
            );
        }

    }








    /*------Member Profile View--------*/
    public function memberProfileView($id)
    {
        $data = DB::table('user_loan_profiles')->where('id', $id)->first();
        return view('manager.member-profile-view', compact('data'));
    }



    public function memberProfileEdit($id)
    {
        $data = DB::table('user_loan_profiles')->where('id', $id)->first();
        return view('manager.member-profile-edit', compact('data'));
    }








    /*--------Loan Member Edit--------------*/
    public function loanmember_Edit($id)
    {
        $data = DB::table('user_loan_profiles')->where('id', $id)->first();
        return view('manager.loan-member-edit', compact('data'));
    }




    public function loanmember_EditByManager(Request $request, $id)
    {

        $totallav = $request->loan_amount * $request->intrestRate/100;
        $totaLamountWithLav = $totallav + $request->loan_amount;
        $TotalIntrestAmountForEveryInstallment = $totaLamountWithLav/$request->loanInstallment;


        try {
            $loan = [];
            $loan['chk_img']                     = $request->chk_img;
            $loan['name']                        = $request->name;
            $loan['mobile']                      = $request->mobile;
            $loan['fathers_name']                = $request->fathers_name;
            $loan['mothers_name']                = $request->mothers_name;
            $loan['loan_owner_Occupation']       = $request->loan_owner_Occupation;
            $loan['loan_owner_card_no']          = $request->loan_owner_card_no;
            $loan['loan_amount']                 = $request->loan_amount;
            $loan['intrestRate']                 = $request->intrestRate;
            $loan['loanInstallment']             = $request->loanInstallment;
            $loan['installmentType']             = $request->installmentType;
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
            $loan['relationgranter']             = $request->relationgranter;
            $loan['granter_name']                = $request->granter_name;
            $loan['granter_mobile']              = $request->granter_mobile;
            $loan['granter_id_card_no']          = $request->granter_id_card_no;
            $loan['granter_fathers_name']        = $request->granter_fathers_name;
            $loan['granter_mothers_name']        = $request->granter_mothers_name;
            $loan['granterOccupation']           = $request->granterOccupation;
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




    /*--------Loan Approve By Manager Logic--------------*/
    public function loanApprove($id){
        try {
            $data = DB::table('user_loan_profiles')->whereNull('deleted_at')->where('id', $id)->update([
                'status'       => '1',
                'manager_aceck_date'     => Carbon::now(),
            ]);


            return back()->with('success', 'Loan Approve Successully');
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }




    public function loanRejected(Request $request, $id)
    {

        try {
            $manager_name = Auth::user()->name;
            $data = DB::table('user_loan_profiles')->where('id', $id)->update([
                'manager_rejected_reason'   => $request->rejected_reason,
                'manager_name'  => $manager_name,
                're_submit_status'     => '1',
                'manager_aceck_date'     => Carbon::now(),
            ]);


            return back()->with('success', 'Loan Rejected Successully');
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }



    public function OfficerreportList()
    {
        $officer_list_withloan_report = User::where('is_admin', '3')->whereNull('deleted_at')->get();
        return view('manager.loanofficer-report-list', [
            'officer_list_withloan_report' => $officer_list_withloan_report,
        ]);
    }




    public function PrintOfficerLoanReport($id)
    {

        $data = User::where('id', $id)->first();

        $loanofficer_profile_info = officer_profile::where('officer_id', $id)->first();

        $total_loan_under_loanofficer = DB::table('user_loan_profiles')->where('status', '3')->where('loan_officer_id', $id)->whereNull('deleted_at')->sum('loan_amount');
        $total_loan_recived_under_loanofficer = DB::table('user_loan_profiles')->where('status', '3')->where('loan_officer_id', $id)->whereNull('deleted_at')->sum('loan_entry');

        $first_loan_aproved_date_under_loanofficer = DB::table('user_loan_profiles')->where('status', '3')->where('loan_officer_id', $id)->whereNull('deleted_at')->orderBy('created_at', 'asc')->first();

        return view('manager.loanofficer_report_print', compact('data', 'total_loan_under_loanofficer','total_loan_recived_under_loanofficer','first_loan_aproved_date_under_loanofficer','loanofficer_profile_info'));
    }






    // END================================================
    function oldform()
    {
       return view("accountsetup.reopen.old_form");
    }

    function editform(Request $request)
    {
        $data = DB::table('user_loan_profiles')->where('loan_close_reason', '1')->where('id', $request->id)->first();
        if($data)
        {
            return view('accountsetup.reopen.loan-member-edit', compact('data'));
        }else{
            return back()->with('error', 'Oops! User NOT FOUND In Old Database');
        }
    }


    function ReOpenLoan(Request $request)
    {

        $totallav = $request->loan_amount * $request->intrestRate/100;
        $totaLamountWithLav = $totallav + $request->loan_amount;
        $TotalIntrestAmountForEveryInstallment = $totaLamountWithLav/$request->loanInstallment;


        $manager_id = Auth::user()->id;
        $manager_branch = Auth::user()->manager_branch;

        $old_loan_info = user_loan_profile::where('id', $request->id)->first();

        try {
            $loan = [];
            $loan['chk_img']   = null;
            $loan['status']                     = '0';
            // 0 = Pending, 1=Pending+manager Aproved, 2=Pending+Noticeadmin Aproved, 3=Aproved, 4=Rejected;
            $loan['loan_officer_id']            = $old_loan_info->loan_officer_id;
            $loan['manager_id']                 = $manager_id;
            $loan['manager_branch']             = $manager_branch;
            $loan['name']                       = $request->name;
            $loan['mobile']                     = $request->mobile;







            $loan['noticeadmin_check_date']                     = null;
            $loan['admin_check_date']                     = null;
            $loan['manager_aceck_date']                     = null;
            $loan['notice_admin_rejected_reason']                     = null;
            $loan['manager_rejected_reason']                     = null;
            $loan['super_admin_rejected_reason']                     = null;
             $loan['loan_close_reason']                     = null;

            $loan['fathers_name']               = $request->fathers_name;
            $loan['mothers_name']               = $request->mothers_name;
            $loan['loan_owner_card_no']         = $request->loan_owner_card_no;
            $loan['loan_owner_Occupation']      = $request->loan_owner_Occupation;
            $loan['loan_amount']                = $request->loan_amount;
            $loan['intrestRate']                = $request->intrestRate;
            $loan['loanInstallment']            = $request->loanInstallment;
            $loan['TotalIntrestAmountForEveryInstallment']            = $TotalIntrestAmountForEveryInstallment;
            $loan['installmentType']            = $request->installmentType;
            $loan['day']                        = $request->day;
            $loan['month']                      = $request->month;
            $loan['year']                       = $request->year;
            $loan['loan_owner_zila']            = $request->loan_owner_zila;
            $loan['loan_owner_upazila']         = $request->loan_owner_upazila;
            $loan['loan_owner_union']           = $request->loan_owner_union;
            $loan['loan_owner_pincode']         = $request->loan_owner_pincode;
            $loan['loan_owner_gram']            = $request->loan_owner_gram;
            $loan['loan_owner_branch']          = $request->loan_owner_branch;
            $loan['relationgranter']            = $request->relationgranter;
            $loan['granter_name']               = $request->granter_name;
            $loan['granter_mobile']             = $request->granter_mobile;
            $loan['granter_id_card_no']         = $request->granter_id_card_no;
            $loan['granter_fathers_name']       = $request->granter_fathers_name;
            $loan['granter_mothers_name']       = $request->granter_mothers_name;
            $loan['granterOccupation']          = $request->granterOccupation;
            $loan['granter_day']                = $request->granter_day;
            $loan['granter_month']              = $request->granter_month;
            $loan['granter_year']               = $request->granter_year;
            $loan['granter_zila']               = $request->granter_zila;
            $loan['granter_upazila']            = $request->granter_upazila;
            $loan['granter_union']              = $request->granter_union;
            $loan['granter_pincode']            = $request->granter_pincode;
            $loan['granter_gram']               = $request->granter_gram;
            $loan['relationgranter2']           = $request->relationgranter2;
            $loan['granter_2_name']             = $request->granter_2_name;
            $loan['granter_2_mobile']           = $request->granter_2_mobile;
            $loan['granter_2_fathers_name']     = $request->granter_2_fathers_name;
            $loan['granter_2_mothers_name']     = $request->granter_2_mothers_name;
            $loan['granter_2_id_card_no']       = $request->granter_2_id_card_no;
            $loan['granter2Occupation']         = $request->granter2Occupation;
            $loan['granter_2_day']              = $request->granter_2_day;
            $loan['granter_2_month']            = $request->granter_2_month;
            $loan['granter_2_year']             = $request->granter_2_year;
            $loan['granter_2_zila']             = $request->granter_2_zila;
            $loan['granter_2_upazila']          = $request->granter_2_upazila;
            $loan['granter_2_union']            = $request->granter_2_union;
            $loan['granter_2_pincode']          = $request->granter_2_pincode;
            $loan['granter_2_gram']             = $request->granter_2_gram;


            $loan['loan_entry']                 = "0";
            $loan['created_at']                 = Carbon::now();
            $loan['form_id']                    = $old_loan_info->form_id;
            // ' => $form_id

            $dataId = DB::table('user_loan_profiles')->where('id', $request->id)->update($loan);


            if ($dataId) {
                if ($request->hasFile('loan_owner_image')) {
                    $image = $request->file('loan_owner_image');
                    $ext = $image->extension();
                    $file = rand(0000, 9999) . '.' . $ext;
                    $image->move('uploads/loan_profile', $file);
                    $loan['loan_owner_image'] = $file;
                }else{
                    $loan['loan_owner_image'] = $old_loan_info->loan_owner_image;
                }
                if ($request->hasFile('loan_owner_id_card')) {
                    $image = $request->file('loan_owner_id_card');
                    $ext = $image->extension();
                    $file = rand(0000, 9999) . '.' . $ext;
                    $image->move('uploads/loan_profile', $file);
                    $loan['loan_owner_id_card'] = $file;
                }else{
                    $loan['loan_owner_id_card'] = $old_loan_info->loan_owner_id_card;
                }
                if ($request->hasFile('granter_image')) {
                    $image = $request->file('granter_image');
                    $ext = $image->extension();
                    $file = rand(0000, 9999) . '.' . $ext;
                    $image->move('uploads/loan_profile', $file);
                    $loan['granter_image'] = $file;
                }else{
                    $loan['granter_image'] = $old_loan_info->granter_image;
                }
                if ($request->hasFile('granter__2_image')) {
                    $image = $request->file('granter__2_image');
                    $ext = $image->extension();
                    $file = rand(0000, 9999) . '.' . $ext;
                    $image->move('uploads/loan_profile', $file);
                    $loan['granter__2_image'] = $file;
                }else{
                    $loan['granter__2_image'] = $old_loan_info->granter__2_image;
                }
                if ($request->hasFile('granter_id_photo')) {
                    $image = $request->file('granter_id_photo');
                    $ext = $image->extension();
                    $file = rand(0000, 9999) . '.' . $ext;
                    $image->move('uploads/loan_profile', $file);
                    $loan['granter_id_photo'] = $file;
                }else{
                    $loan['granter_id_photo'] = $old_loan_info->granter_id_photo;
                }
                if ($request->hasFile('granter2_id_photo')) {
                    $image = $request->file('granter2_id_photo');
                    $ext = $image->extension();
                    $file = rand(0000, 9999) . '.' . $ext;
                    $image->move('uploads/loan_profile', $file);
                    $loan['granter2_id_photo'] = $file;
                }else{
                    $loan['granter2_id_photo'] = $old_loan_info->granter2_id_photo;
                }

                DB::table('user_loan_profiles')->where('id', $dataId)->update($loan);
            }


            RecivedLoan::where('loan_id', $request->id)->delete();


            return back()->with('success', 'User Loan Profile Resubmit Successfully');
        } catch (Exception $th) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }

    }



}
