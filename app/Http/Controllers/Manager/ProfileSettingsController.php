<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile_form()
    {
        $manager_id = Auth::user()->id;
        // dd($manager_id);

        $data = DB::table('manager_profiles')->where('manager_id', $manager_id)->get();
        if ($data) {
            return view('manager.profile-settings', ['data' => $data]);
        } else {
            return view('manager.profile-settings', ['data' => $data]);
        }
    }




    public function profile_change(Request $request)
    {


        $request->validate(
            [
                'name'            => 'required',
                'photo'           => 'required|mimes:jpeg,jpg,png',
                'email'           => 'required',
                'mobile'          => 'required',
                'address'         => 'required',
            ]
        );


        $branch = Auth::user()->manager_branch;
        $manager_id  = Auth::user()->id;

        $data = DB::table('manager_profiles')->where('manager_id', $manager_id)->first();

        if ($data) {
            //dd($data);
            $profile = [];
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $ext = $image->extension();
                $file = time() . '.' . $ext;
                $image->move('uploads/profile', $file);
                $profile['photo'] = $file;
            }
            $profile['name']    = $request->name;
            $profile['manager_id'] = $manager_id;
            $profile['manager_branch']  = $branch;
            $profile['email']   = $request->email;
            $profile['mobile']  = $request->mobile;
            $profile['address'] = $request->address;


            $data = DB::table('manager_profiles')->where('manager_id', $manager_id)->update($profile);
            return back()->with('success', 'Profile Updated Successfully');
        } else {
            $profile = [];
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $ext = $image->extension();
                $file = time() . '.' . $ext;
                $image->move('uploads/profile', $file);
                $profile['photo'] = $file;
            }
            $profile['name']    = $request->name;
            $profile['manager_id'] = $manager_id;
            $profile['manager_branch']  = $branch;
            $profile['email']   = $request->email;
            $profile['mobile']  = $request->mobile;
            $profile['address'] = $request->address;

            $data = DB::table('manager_profiles')->insert($profile);
            return back()->with('success', 'Profile Updated Successfully');
        }
    }
}
