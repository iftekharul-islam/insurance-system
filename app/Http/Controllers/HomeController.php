<?php

namespace App\Http\Controllers;

use App\Models\notice_tbl;
use App\Models\RecivedLoan;
use App\Models\user_loan_profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $allNotice = notice_tbl::all();
        foreach ($allNotice as $key => $notice) {
            if (!empty($notice->notice_validati) && $notice->notice_validati < Carbon::now()) {
                return $notice->delete();
            }
        }
        $data = notice_tbl::all();
        return view('all-dashboard',['data' => $data]);

    }


    // Account Close
    public function LoanSetUp()
    {
        return view('accountsetup.oldform');
    }


    public function getForminfoForClose(Request $request)
    {
        $id = $request->post('did');
        $state = user_loan_profile::where('form_id', $id)->whereNull('loan_close_reason')->where('status', 3)->get();
        echo $state;
    }


    public function getForminstallmentForClose(Request $request)
    {
        $id = $request->post('did');
        $loan_main_id = user_loan_profile::where('form_id', $id)->whereNull('loan_close_reason')->where('status', "3")->first();
        if (!empty($loan_main_id->id)) {
            $state = RecivedLoan::where('loan_id', $loan_main_id->id)->orderBy('updated_at', 'DESC')->first();
            echo $state;
        }else{
            echo "";
        }
    }



    public function LoanSetUpDetails($id)
    {   $data = user_loan_profile::where('id', $id)->first();
        return view('accountsetup.index', compact('data'));
    }


    public function LoanAccountSumbitForClose(Request $request)
    {

        if ($request->id) {

            $loaninfo = user_loan_profile::where('id', $request->id)->first();

                if ($loaninfo->loan_entry == $loaninfo->loan_amount) {
                    $data = user_loan_profile::where('id', $request->id)->update([
                        'loan_close_reason' => '2',
                        'loan_close_reason_text' => $request->loan_close_reason,
                    ]);

                    return back()->with('success', 'Close Request Submitted Successfully');
                }else{

                    $loan_due_amount =  $loaninfo->loan_amount - $loaninfo->loan_entry;

                    if (!empty($request->loan_entry_amount) && ($request->loan_entry_amount == $loan_due_amount)) {
                        $data = user_loan_profile::where('id', $request->id)->update([
                            'loan_entry'    => $loaninfo->loan_entry + $request->loan_entry_amount,
                            'loan_close_reason' => '2',
                            'loan_close_reason_text' => $request->loan_close_reason,
                        ]);

                        $update_loan_info = user_loan_profile::where('id', $request->id)->first();

                        RecivedLoan::insert([
                            'loan_id' => $update_loan_info->id,
                            'recived_amount' => $request->loan_entry_amount,
                            'due_amount' => $loaninfo->loan_amount-$update_loan_info->loan_entry,
                            'loanInstallment_remarks' => $request->remarks,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        return back()->with('success', 'Close Request Submitted Successfully');
                    } else {
                        return back()->with('error', 'First Submit Your Due Amount!');
                    }

                }

        } else {
            return back()->with('error', 'Somting Wrong');
        }


    }







    // Loan Profile Print
    public function LoanProfilePrint(Request $request, $id)
    {
        $id = base64_decode($id);
        $recived_history_q = DB::table('recived_loans')->where('loan_id', $id);
        if($request->input("from_date") && $request->input("to_date")){
            $recived_history_q->where("created_at",">=", $request->input("from_date")." 00:00:00");
            $recived_history_q->where("created_at","<=", $request->input("to_date"). " 23:59:00");
        }

        $recived_history = $recived_history_q->get();
        //dd($recived_history->first()->created_at);
        if($recived_history->count() > 0){
            $from_date = \Carbon\Carbon::parse($recived_history->first()->created_at)->format("Y-m-d");
            $to_date = \Carbon\Carbon::parse($recived_history->last()->created_at)->format("Y-m-d");
        }else{
            $from_date = \Carbon\Carbon::now()->subYears(1)->format("Y-m-d");
            $to_date = \Carbon\Carbon::now()->format("Y-m-d");
        }


        $data = DB::table('user_loan_profiles')->where('id', $id)->first();
        return view('single_loan_profile_report_print', compact('data', 'recived_history', 'from_date', 'to_date'));
    }







    // getUpazila getUnions getgranter_Upazila getgranter_Unions getgranter_2_Upazila getgranter_2_Unions
    public function getUpazila(Request $request)
    {
        $did = $request->post('did');
        $state = DB::table('upazilas')->where('district_id', $did)->orderBy('name', 'asc')->get();
        $html = '<option value="">--Select Thana / Upazila --</option>';
        foreach ($state as $list) {
            $html .= '<option value="' . $list->id . ':' . '' . $list->name . '">' . $list->name . '</option>';
        }
        echo $html;
    }

    public function getUnions(Request $request)
    {
        $uid = $request->post('uid');
        $state = DB::table('unions')->where('upazilla_id', $uid)->orderBy('name', 'asc')->get();
        $html = '<option value="">--Select Union--</option>';
        foreach ($state as $list) {
            $html .= '<option value="' . $list->id . ':' . '' . $list->name . '">' . $list->name . '</option>';
        }
        echo $html;
    }

    public function getgranter_Upazila(Request $request)
    {
        $did = $request->post('did');
        $state = DB::table('upazilas')->where('district_id', $did)->orderBy('name', 'asc')->get();
        $html = '<option value="">--Select Thana / Upazila --</option>';
        foreach ($state as $list) {
            $html .= '<option value="' . $list->id . ':' . '' . $list->name . '">' . $list->name . '</option>';
        }
        echo $html;
    }

    public function getgranter_Unions(Request $request)
    {
        $uid = $request->post('uid');
        $state = DB::table('unions')->where('upazilla_id', $uid)->orderBy('name', 'asc')->get();
        $html = '<option value="">--Select Union--</option>';
        foreach ($state as $list) {
            $html .= '<option value="' . $list->id . ':' . '' . $list->name . '">' . $list->name . '</option>';
        }
        echo $html;
    }


    public function getgranter_2_Upazila(Request $request)
    {
        $did = $request->post('did');
        $state = DB::table('upazilas')->where('district_id', $did)->orderBy('name', 'asc')->get();
        $html = '<option value="">--Select Thana / Upazila --</option>';
        foreach ($state as $list) {
            $html .= '<option value="' . $list->id . ':' . '' . $list->name . '">' . $list->name . '</option>';
        }
        echo $html;
    }

    public function getgranter_2_Unions(Request $request)
    {
        $uid = $request->post('uid');
        $state = DB::table('unions')->where('upazilla_id', $uid)->orderBy('name', 'asc')->get();
        $html = '<option value="">--Select Union--</option>';
        foreach ($state as $list) {
            $html .= '<option value="' . $list->id . ':' . '' . $list->name . '">' . $list->name . '</option>';
        }
        echo $html;
    }
    // getUpazila getUnions getgranter_Upazila getgranter_Unions getgranter_2_Upazila getgranter_2_Unions








    public function changePassword_Page()
    {
        return view('admin.change-password');
    }

    public function changePassword_update(Request $request)
    {
        $request->validate(
            [
                'password'=> ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            ]
        );
        $id = Auth::user()->id;
        $data = DB::table('users')->where('id', $id)->update([
            'password' => Hash::make($request->password)
        ]);
        return back()->with('success', 'Password Updated Successfull');
    }



    public function NotificationView($id){
        $notification = DB::table('notifications')->where('id', $id)->first();
        $data = DB::table('user_loan_profiles')->where('id', $notification->n_type_id)->first();

        if ($data) {
            $notification = DB::table('notifications')->where('id', $id)->update([
                'n_status' => "seen"
            ]);
            return view('n-view-form', ['data' => $data]);
        }else{
            DB::table('notifications')->where('id', $id)->delete();
            return back();
        }

    }






}
