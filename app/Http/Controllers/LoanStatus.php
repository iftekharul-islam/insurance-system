<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_loan_profile;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class LoanStatus extends Controller
{
    public function index()
    {
        return view('loan-status');
    }

    public function GetStatus(Request $request)
    {
        $loan_status = user_loan_profile::where('form_id', $request->form_number)->first();

            if (!empty($loan_status)) {
                $this_loan_officer = User::where('id', $loan_status->loan_officer_id)->first()->name;
                $this_loan_manager = User::where('id', $loan_status->manager_id)->first()->name;
                $notice_admin = User::where('is_admin', '4')->first()->name;
                $super_admin = User::where('is_admin', '1')->first()->name;
            }else{
                $this_loan_officer = [];
                $this_loan_manager = [];
                $notice_admin = [];
                $super_admin = [];
            }
            
            return view('loan-status',[
                'loan_status' => $loan_status,
                'this_loan_officer' => $this_loan_officer,
                'this_loan_manager' => $this_loan_manager,
                'notice_admin' => $notice_admin,
                'super_admin' => $super_admin,
            ]);

    }


}
