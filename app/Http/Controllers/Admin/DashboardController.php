<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\manager_profile;
use App\Models\User;
use App\Models\user_loan_profile;
use App\Models\UserLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UserLog($id){
        $loginfo =UserLog::where('user_id', $id)->first();
        $user_info = DB::table('users')->where('id', $id)->first();
        return view('admin.stoff-profile.progile-log-info',[
            'loginfo' => $loginfo,
            'user_info' => $user_info,
        ]);
    }





    public function ManagerreportList()
    {
        if (auth()->user()->is_admin != 1) {
            abort(403);
        }
        // $manager_loan = user_loan_profile::with('manageuser')->get();

        // $loan_taken_by_loan_officer = $manager_loan->mapToGroups(function ($item, $key) {
        //     return [$item['manager_id'] => ["total_amount" => $item['loan_amount'], "loaner_name" => $item['name'], "id" => $item['manager_id'], "loan_office" => @$item['manageuser']['name'], "wapisloan" => $item['loan_entry']]];
        // });

        $manager_list_withloan_report = User::where('is_admin', '2')->whereNull('deleted_at')->get();
        return view('admin.managerloanreport', [
            'manager_list_withloan_report' => $manager_list_withloan_report,
        ]);
    }




    public function PrintManagerLoanReport($id)
    {

        $data = User::where('id', $id)->first();

        $manager_profile_info = manager_profile::where('manager_id', $id)->first();

        $total_loan_under_manager = DB::table('user_loan_profiles')->where('status', '3')->where('manager_id', $id)->whereNull('deleted_at')->sum('loan_amount');
        $total_loan_recived_under_manager = DB::table('user_loan_profiles')->where('status', '3')->where('manager_id', $id)->whereNull('deleted_at')->sum('loan_entry');

        $first_loan_aproved_date_under_manager = DB::table('user_loan_profiles')->where('status', '3')->where('manager_id', $id)->whereNull('deleted_at')->orderBy('created_at', 'asc')->first();

        return view('admin.manager_loan_report_print', compact('data', 'total_loan_under_manager','total_loan_recived_under_manager','first_loan_aproved_date_under_manager','manager_profile_info'));
    }




}
