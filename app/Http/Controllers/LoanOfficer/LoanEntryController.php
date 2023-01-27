<?php

namespace App\Http\Controllers\LoanOfficer;

use App\Http\Controllers\Controller;
use App\Models\RecivedLoan;
use App\Models\user_loan_profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoanEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function loanEntryFrom(){
        Session::forget('LeftInstallment');
        $id = Auth::user()->id;
        $data = DB::table('user_loan_profiles')->whereNull('loan_close_reason')->where('loan_officer_id', $id)->get();
        return view('loan_officer.recived-amount', ['data' => $data]);
    }



    public function getForminfo(Request $request)
    {
        $id = $request->post('did');
        $state = user_loan_profile::where('form_id', $id)->whereNull('loan_close_reason')->where('status', 3)->get();
//        logger($state);
        echo $state;
    }




    public function loanEntry(Request $request)
    {

        if(empty($request->id)) {
            return back()->with('error', 'Something Went Wrong');
        }elseif(empty($request->form_number)){
            return back()->with('error', 'Something Went Wrong');
        }else{
            $loaninfo = user_loan_profile::where('id', $request->id)->first();

            $data = user_loan_profile::where('id', $request->id)->update([
                'loan_entry'    => $loaninfo->loan_entry + $request->loan_entry_amount,
                'sms' => 'send',
            ]);



            if ($data) {
                $update_loan_info = user_loan_profile::where('id', $request->id)->first();
                $successdata = RecivedLoan::insert([
                    'loan_id' => $update_loan_info->id,
                    'recived_amount' => $request->loan_entry_amount,
                    'due_amount' => $loaninfo->loan_amount-$update_loan_info->loan_entry,
                    'loanInstallment_remarks' => $request->remarks,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                if ($successdata) {
                    if ($loaninfo->mobile) {
                        $message = "Dear Sir, BFSS-Ltd. deposit balance of your account ".$loaninfo->form_id." is BDT ".$request->loan_entry_amount."৳ as on ". Carbon::now()->format('d-m-Y h:ia').". For details please visit your offices.";
                        $template = settings()->sms1;
                        if($template != "" || $template != null){
                            $template = str_replace("{form_id}", $loaninfo->form_id, $template);
                            $template = str_replace("{amount}", $request->loan_entry_amount, $template);
                            $template = str_replace("{date}", Carbon::now()->format('d-m-Y h:ia'), $template);
                            $message = $template;
                            //$message = urlencode($message);
                        }

                        $reciver_mobile = $loaninfo->mobile;
                        $username = "8809601004416";
                        if(settings()->sms1_is_enable == 1){
                            //$smsresult = file_get_contents("https://bulksmsbd.net/api/smsapi?api_key=GjKDTrfYuQrhlDA0IOy1&type=text&number=$reciver_mobile&senderid=$username&message=$message");

                            //function sms_send() {
                            $url = "https://bulksmsbd.net/api/smsapi";
                            $api_key = "GjKDTrfYuQrhlDA0IOy1";
                            $senderid = "$username";
                            $number = "$reciver_mobile";
                            $message = $message;

                            $data = [
                                "api_key" => $api_key,
                                "senderid" => $senderid,
                                "number" => $number,
                                "message" => $message
                            ];
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $response = curl_exec($ch);
                            curl_close($ch);
                            //return $response;
                            //}
                        }
                    }
                    return back()->with('success', 'Loan Submitted Successfully This User');

                }
            }



        }

    }




    public function getForminstallment(Request $request)
    {
        $id = $request->post('did');
        $loan_main_id = user_loan_profile::where('form_id', $id)->where('status', "3")->whereNull('loan_close_reason')->first();
        if (!empty($loan_main_id->id)) {
            $state = RecivedLoan::where('loan_id', $loan_main_id->id)->orderBy('updated_at', 'DESC')->first();
            echo $state;
        }else{
            echo "";
        }
    }

    public function getForminstallmentData(Request $request)
    {
        $id = $request->post('did');
        $loan_main_id = user_loan_profile::where('form_id', $id)->where('status', "3")->whereNull('loan_close_reason')->first();
        if (!empty($loan_main_id->id)) {
            $state = RecivedLoan::where('loan_id', $loan_main_id->id)->orderBy('updated_at', 'DESC')->first();
            $total = $loan_main_id->loan_amount + ($loan_main_id->intrestRate * $loan_main_id->loan_amount)/100;
            $remaining_amount = $total / $loan_main_id->loanInstallment;
            return [
                'remaining' => $state->recived_amount ? $loan_main_id->loanInstallment - (($loan_main_id->loanInstallment * $state->loan_entry)/$total) : $loan_main_id->loanInstallment,
                'paid' => $loan_main_id->loan_entry,
                'due' =>  $total - $loan_main_id->loan_entry,
                'date' => Carbon::parse($state->updated_at)->format('d M, Y'),
            ];
        }else{
            echo "";
        }
    }



}
