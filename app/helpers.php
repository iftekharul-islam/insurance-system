<?php

use App\Models\RecivedLoan;
use App\Models\site_setting;
use App\Models\user_loan_profile;
use Illuminate\Support\Facades\DB;

function Notification(){
    return DB::table('lon_edit_requests')->whereNull('deleted_at')->where('seenstatus', 'unseen')->get();
}

if (!function_exists('macId')) {
    function macId(){
        return substr(exec('getmac'), 0, 17);
    }
}






function settings(){
    return DB::table('site_settings')->where('id', 1)->first();
}


function OfficerProfile($id){
    return DB::table('officer_profiles')->where('officer_id', $id)->first();
}
function ManagerProfile($id){
    return DB::table('manager_profiles')->where('manager_id', $id)->first();
}




function ManagerNotification($id){

    $notification = user_loan_profile::where('manager_id', $id)->pluck('id');

    $noti = DB::table('notifications')->where('n_for', "manager")->where('n_status', "unseen")->whereIn('n_type_id', $notification)->get();
    return $noti;

}


function OfficerNotification($id){

    $notification = DB::table('user_loan_profiles')->where('loan_officer_id', $id)->pluck('id')->all();
    $noti = DB::table('notifications')->where('n_for', "loanOfficer")->where('n_status', "unseen")->whereIn('n_type_id', $notification)->get();
    return $noti;


    // return DB::table('notifications')->where('n_for', "loanOfficer")->where('n_status', "unseen")->get();
}





function SuperAdminNotification(){
    return DB::table('notifications')->where('n_for', "superAdmin")->where('n_status', "unseen")->get();
}
function NoticeAdminNotification(){
    return DB::table('notifications')->where('n_for', "noticeAdmin")->where('n_status', "unseen")->get();
}


function LoanInfoById($id){
    return DB::table('user_loan_profiles')->where('id', $id)->first();
}
