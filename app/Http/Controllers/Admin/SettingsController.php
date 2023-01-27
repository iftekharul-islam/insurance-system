<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class SettingsController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function settings_Page()
    {
        $data = DB::table('site_settings')->get();
        return view('admin.system.settings', ['data' => $data]);
    }




    public function settings_Update(Request $request){

        $settings = [];
        if ($request->hasFile('site_logo')) {
            $image = $request->file('site_logo');
            $ext = $image->extension();
            $file = time() . '.' . $ext;
            $image->move('uploads/logo', $file);
            $settings['site_logo'] = $file;
        }

        if ($request->hasFile('printing_logo')) {
            $image = $request->file('printing_logo');
            $ext = $image->extension();
            $file = time() . '.' . $ext;
            $image->move('uploads/logo', $file);
            $settings['printing_logo'] = $file;
        }

        if ($request->hasFile('home_logo')) {
            $image = $request->file('home_logo');
            $ext = $image->extension();
            $file = time() . '.' . $ext;
            $image->move('uploads/logo', $file);
            $settings['home_logo'] = $file;
        }

        if ($request->hasFile('fb_page_img')) {
            $image = $request->file('fb_page_img');
            $ext = $image->extension();
            $file = time() . '.' . $ext;
            $image->move('uploads/logo', $file);
            $settings['fb_page_img'] = $file;
        }


        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $ext = $image->extension();
            $file = time() . '.' . $ext;
            $image->move('uploads/logo', $file);
            $settings['favicon'] = $file;
        }


        $settings['fb_link'] = $request->fb_link;
        $settings['twitter_link'] = $request->twitter_link;
        $settings['insta_link'] = $request->insta_link;
        $settings['linkdin_link'] = $request->linkdin_link;
        $settings['mobile_no'] = $request->mobile_no;
        $settings['office_address'] = $request->office_address;
        $settings['email'] = $request->email;
        $settings['map'] = $request->map;
        $settings['sms1'] = $request->sms1;
        $settings['sms2'] = $request->sms2;

        $settings['sms1_is_enable'] = $request->sms1_is_enable == "on" ? 1: 0;
        $settings['sms2_is_enable'] = $request->sms2_is_enable == "on" ? 1: 0;

        $data = DB::table('site_settings')->update($settings);
        return back()->with('success', 'Site Settings Updated Successfull');

    }

    public function db_backup_Page(Request $request){
        $data = DB::table('db_backups')->orderBy('id','desc')->get();
        return view('admin.system.db_backup', ['data' => $data]);
    }

    public function create_db_backup(Request $request){

        $public_path = public_path();
        if(!File::exists($public_path."/uploads/db_backup")){
            File::makeDirectory($public_path."/uploads/db_backup", 0755, true, true);
        }
        $host = config('database.connections.mysql.host');
        $database = config('database.connections.mysql.database');
        $user = config('database.connections.mysql.username');
        $pass = config('database.connections.mysql.password');

        $save_path = $public_path."/uploads/db_backup";

        $backup_file = "loan_".date("Y-m-d-H-i-s") . '.gzip';
        $command = "mysqldump --opt -h $host -u$user -p$pass ". "$database | gzip > $save_path/$backup_file";
        system($command);

        $data = ["file" => $backup_file, 'created_at' => now(), 'updated_at' => now()];
        DB::table('db_backups')->insert($data);
    }
}
