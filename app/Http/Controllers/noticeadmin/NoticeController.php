<?php

namespace App\Http\Controllers\noticeadmin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function notice_page()
    {
        $data = DB::table('notice_tbls')->get();
        return view('noticeadmin.notice.notice-page', ['data' => $data]);
    }



    public function notice_create(Request $request)
    {



        $this->validate($request, [
            'notice'  => 'required',
            'notice_validati'  => 'date|after:tomorrow',
        ]);

        // notice_validati
        // noticestatus

        $notice = [];
        $notice['notice'] = $request->notice;
        $notice['notice_validati'] = $request->notice_validati;
        $notice['noticestatus'] = $request->noticestatus;
        $notice['notice_dec'] = $request->notice_dec;
        $notice['notice_type'] = "pdf";
        $notice['created_at'] = Carbon::now();

        if ($request->hasFile('notice_pdf')) {
            $image = $request->file('notice_pdf');
            $ext = $image->extension();
            $file = rand(0000, 9999) . '.' . $ext;
            $image->move('uploads/pdf', $file);
            $notice['notice_pdf'] = $file;
        }

        $data = DB::table('notice_tbls')->insert($notice);

        return back()->with('success', 'Notice Created Successully');
    }


    //edit
    public function notice_Edit($id)
    {
        $data = DB::table('notice_tbls')->where('id', $id)->first();
        return view('noticeadmin.notice.notice-edit', compact('data'));
    }

    public function notice_Update(Request $request, $id)
    {
        $this->validate($request, [
            'notice_validati'  => 'date|after:tomorrow',
        ]);

        $data = DB::table('notice_tbls')->where('id', $id)->update([
            'notice'   =>  $request->notice,
            'notice_dec' => $request->notice_dec,
            'noticestatus'   => $request->noticestatus,
            'notice_validati' => $request->notice_validati,
        ]);


        if ($request->hasFile('notice_pdf')) {
            $image = $request->file('notice_pdf');
            $ext = $image->extension();
            $file = rand(0000, 9999) . '.' . $ext;
            $image->move('uploads/pdf', $file);
            $notice['notice_pdf'] = $file;
        }


        return back()->with('success', 'Notice Updated Successully');
    }

    public function notice_Delete($id)
    {
        $data = DB::table('notice_tbls')->where('id', $id)->delete();
        return back()->with('success', 'Notice Deleted Successfully');
    }

    public function all_notice()
    {
        $data = DB::table('notice_tbls')->get();
        return view('noticeadmin.notice.all-notice', ['data' => $data]);
    }
}
