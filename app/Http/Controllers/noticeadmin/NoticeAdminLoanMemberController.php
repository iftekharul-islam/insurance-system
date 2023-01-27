<?php

namespace App\Http\Controllers\noticeadmin;

use App\Http\Controllers\Controller;
use App\Models\user_loan_profile;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class NoticeAdminLoanMemberController extends Controller
{
    public function allMemberListNotic(){
        $status = ["1","2","3","4"];
        try {
            $data = DB::table('user_loan_profiles')->whereNull('deleted_at')->whereIn("status",$status)->latest()->get();
            return view('noticeadmin.loan-member-list', ['data' => $data]);
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }


    public function MemberByStatusListNotice(Request $request)
    {
        $status = ["1","2","3","4"];
        if ($request->loanstats == "4") {
            $status = ["1","2","4"];
            $Rejected_loan_profile = user_loan_profile::where('re_submit_status','1')->whereIn("status",$status)->whereNull('deleted_at')->orderBy('name', 'asc')->get();
            return view('noticeadmin.loan-member-list', [
                'data' => $Rejected_loan_profile,
                'selected_type' => $request->loanstats
                ]
            );

            // $pending_loan_profile = user_loan_profile::where(function($query) {
            //     $query->where('status', '4')->orWhere('re_submit_status', '1');
            // })->get();

        }else{
            $pending_loan_profile = user_loan_profile::where('status', $request->loanstats)->whereNull('re_submit_status')->whereIn("status",$status)->orderBy('name', 'asc')->get();
            return view('noticeadmin.loan-member-list', [
                'data' => $pending_loan_profile,
                'selected_type' => $request->loanstats
                ]
            );
        }

    }



    public function MemberViewByNotic($id)
    {
        $id = base64_decode($id);
        try {
            $data = DB::table('user_loan_profiles')->where('id', $id)->first();
            return view('noticeadmin.member-view-profile', compact('data'));
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }




    public function MemberEditByNotic($id)
    {
        $data = DB::table('user_loan_profiles')->where('id', $id)->first();
        return view('noticeadmin.loan-mamber-edit', compact('data'));
    }

    public function MemberEditPostByNotic(Request $request, $id)
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







    /*--------Reject Loan Profile By Super Admin-----------*/
    public function MemberLoanRejectedByNoticeAdmin(Request $request,$id)
    {

        try {
            $data = DB::table('user_loan_profiles')->where('id', $id)->update([
                're_submit_status'     => '1',
                'noticeadmin_check_date'     => Carbon::now(),
                'notice_admin_rejected_reason'     => $request->rejected_reason,

            ]);


            return back()->with('success', 'Loan Rejected Successfull');
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }





    /*--------Loan Approve By Manager Logic--------------*/
    public function loanApproveByNoticeAdmin($id){
        try {
            $data = DB::table('user_loan_profiles')->whereNull('deleted_at')->where('id', $id)->update([
                'status'       => '2',
                'noticeadmin_check_date'     => Carbon::now(),
            ]);


            return back()->with('success', 'Loan Approve Successully');
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }




}
