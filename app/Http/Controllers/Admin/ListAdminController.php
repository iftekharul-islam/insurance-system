<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\user_loan_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class ListAdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listadmin_Page()
    {
        $data = DB::table('users')->where('id' ,'!=', "0")->get();
        return view('admin.stoff-profile.list-admin', ['data' => $data]);
    }



    public function listadmin_Post(Request $request)
    {
        $request->validate(
            [
                'name'            => 'required',
                'email'           => 'required||string||max:255||unique:users',
                'password'        => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
                'is_admin'        => 'required'
            ],
            [
                'email.required' => 'User Name Fild id Required',
                'email.unique'   => 'User Name Must be Unique',
            ]
        );


        $data = DB::table('users')->insert([
            'name'               =>  $request->name,
            'email'              => $request->email,
            'phone'              => $request->phone,
            'manager_branch'     => $request->manager_branch,
            'password'           => Hash::make($request->password),
            'is_admin'           => $request->is_admin
        ]);


        return back()->with('success', 'Admin Created Successully');
    }


    public function listadmin_Edit($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return view('admin.stoff-profile.admin-edit', compact('data'));
    }



    public function listadmin_Update(Request $request, $id)
    {

        $request->validate(
            [
                'name'            => 'required',
                'email'           => 'required||string||max:255||unique:users,email,' . $id,
                'is_admin'        => 'required',
                'phone'           => 'required'
            ],
            [
                'email.required' => 'User Name Field id Required',
                'email.unique'   => 'User Name Must be Unique',
            ]
        );

        if ($request->input("password")) {
            $request->validate(
                [
                    'password'        => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
                ]
            );
        }

        $data = [
            'name'   =>  $request->name,
            'email'        => $request->email,
            'phone'     => $request->phone,
            'manager_branch'    => $request->manager_branch,
            'is_admin'    => $request->is_admin
        ];
        if($request->input("password") && $request->input("password") != ""){
            $data['password'] = Hash::make($request->password);
        }
        DB::table('users')->where('id', $id)->update($data);

        return back()->with('success', 'Admin Updated Successully');
    }





    public function listadmin_Delete($id)
    {
        $data = DB::table('users')->where('id', $id)->delete();
        return back()->with('success', 'Admin Deleted Successfully');
    }

    public function listadmin_status($id)
    {
        $data = User::where('id', $id)->first();
        $data->status = $data->status == 1 ? 2 : 1;
        $data->save();
        return back()->with('success', 'Admin status updated Successfully');
    }






}
