<?php

namespace App\Http\Controllers\LoanOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoanOfficerProfileSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile_form()
    {
        $data = DB::table('officer_profiles')->get();
        return view('loan_officer.profile-settings', ['data' => $data]);
    }




    public function profile_change(Request $request)
    {

        $request->validate(
            [
                'name'            => 'required',
                'photo'           => 'mimes:jpeg,jpg,png',
                'email'           => 'required',
                'mobile'          => 'required',
                'address'         => 'required',
            ]
        );


        $branch = Auth::user()->manager_branch;
        $officer_id = Auth::user()->id;
        $data = DB::table('officer_profiles')->where('officer_id', $officer_id)->first();

        if ($data) {
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $ext = $image->extension();
                $file = time() . '.' . $ext;
                $image->move('uploads/profile', $file);
                $profile['photo'] = $file;
            }
            $profile['name']    = $request->name;
            $profile['manager_branch']  = $branch;
            $profile['officer_id']     = $officer_id;
            $profile['email']   = $request->email;
            $profile['mobile']  = $request->mobile;
            $profile['address'] = $request->address;

            $data = DB::table('officer_profiles')->where('officer_id', $officer_id)->update($profile);
            return back()->with('success', 'Profile Updated Successfully');
        }

        $profile = [];
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $ext = $image->extension();
            $file = time() . '.' . $ext;
            $image->move('uploads/profile', $file);
            $profile['photo'] = $file;
        }
        $profile['name']        = $request->name;
        $profile['manager_branch']    = $branch;
        $profile['officer_id']     = $officer_id;
        $profile['email']        = $request->email;
        $profile['mobile']    = $request->mobile;
        $profile['address']    = $request->address;

        $data = DB::table('officer_profiles')->insert($profile);
        return back()->with('success', 'Profile Updated Successfully');
    }
}
