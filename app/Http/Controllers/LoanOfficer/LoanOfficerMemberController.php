<?php

namespace App\Http\Controllers\LoanOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_loan_profile;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoanOfficerMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }




    public function userProfile_form()
    {
        return view('loan_officer.user-form');
    }

    public function userProfile_post(Request $request)
    {
        $totallav = $request->loan_amount * $request->intrestRate/100;
        $totaLamountWithLav = $totallav + $request->loan_amount;
        $TotalIntrestAmountForEveryInstallment = $totaLamountWithLav/$request->loanInstallment;

        $request->validate(
            [
                '*'                      => 'required',
                'loan_owner_image'       => 'mimes:jpeg,jpg,png',
                'loan_owner_id_card'     => 'mimes:jpeg,jpg,png',
                'granter2_id_photo'      => 'mimes:jpeg,jpg,png',
                'granter_id_photo'       => 'mimes:jpeg,jpg,png',
                'granter_image'          => 'mimes:jpeg,jpg,png',
                'granter__2_image'       => 'mimes:jpeg,jpg,png',

            ]
        );


        $loan_officer_id = Auth::user()->id;
        $manager_id = Auth::user()->manager_id;
        $manager_branch = Auth::user()->manager_branch;

        try {
            $loan = [];
            $loan['chk_img']   = null;
            $loan['status']                     = '0';
            // 0 = Pending, 1=Pending+manager Aproved, 2=Pending+Noticeadmin Aproved, 3=Aproved, 4=Rejected;
            $loan['loan_officer_id']            = $loan_officer_id;
            $loan['manager_id']                 = $manager_id;
            $loan['manager_branch']             = $manager_branch;

            $loan['name']                       = $request->name;
            $loan['mobile']                     = $request->mobile;
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


            $dataId = DB::table('user_loan_profiles')->insertGetId($loan);



            if ($dataId) {
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

                DB::table('user_loan_profiles')->where('id', $dataId)->update($loan);
            }



            $form_id = 1057800000+$dataId;
            $data = DB::table('user_loan_profiles')->where('id', $dataId)->update([
                'form_id' => $form_id
            ]);


            return back()->with('success', 'User Loan Profile Created Successfully');
        } catch (Exception $th) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }

    public function LoanOfficerMemberList()
    {
        $id = Auth::user()->id;
        $data = DB::table('user_loan_profiles')->whereNull('deleted_at')->where('loan_officer_id', $id)->get();
        return view('loan_officer.loanofficer-member-list', ['data' => $data]);
    }

    public function MemberListByStatus(Request $request){
        $pid = $request->loanstats;

        if ($pid == "0") {
            $pending_status_id = array("0", "1", "2");
            $pending_loan_profile = user_loan_profile::WhereIn('status', $pending_status_id)->orderBy('name', 'asc')->get();
            return view('loan_officer.loanofficer-member-list', [
                'data' => $pending_loan_profile,
                'selected_type' => $pid
            ]);
        }
        elseif ($pid == "4") {
            $rejected_status_id = array("4");
            // $pending_loan_profile = user_loan_profile::WhereIn('status', $rejected_status_id)->where('re_submit_status', '1')->orderBy('name', 'asc')->get();

            $pending_loan_profile = user_loan_profile::where(function($query) {
                $query->where('status', '4')->orWhere('re_submit_status', '1');
            })->get();

            return view('loan_officer.loanofficer-member-list', [
                'data' => $pending_loan_profile,
                'selected_type' => $pid
            ]);

        }
        else{
            $pending_loan_profile = user_loan_profile::where('status', $pid)->orderBy('name', 'asc')->get();
            return view('loan_officer.loanofficer-member-list', [
                'data' => $pending_loan_profile,
                'selected_type' => $pid
                ]
            );
        }


    }



    public function OfficerMemberView($id)
    {
        try {
            $data = DB::table('user_loan_profiles')->whereNull('deleted_at')->where('id', $id)->first();
            return view('loan_officer.application-view', compact('data'));
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }



    public function LoanOfficerMemberEdit($id)
    {
        try {
            $data = DB::table('user_loan_profiles')->whereNull('deleted_at')->where('id', $id)->first();
            return view('loan_officer.loan-edit-from', compact('data'));
        } catch (Exception $e) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }




    public function LoanOfficerMemberEditPost(Request $request, $id)
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



            $loan['re_submit_status']                            = null;
            $loan['notice_admin_rejected_reason']                            = null;
            $loan['manager_rejected_reason']                            = null;
            $loan['super_admin_rejected_reason']                            = null;


            $data = DB::table('user_loan_profiles')->where('id', $id)->update($loan);



            return back()->with('success', 'User Loan Profile Updated Successfully');
        } catch (Exception $th) {
            return back()->with('error', 'Oops! Something Went Wrong');
        }
    }








}
