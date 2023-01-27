<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function adminForgotPassword(Request $request){
        return view('auth.admin-resetpassword');
    }

    public function sendTempPasswordAdmin(Request $request){
        $email = $request->input("email");
        $user = User::whereEmail($email)->first();
        if($user && $user->is_admin == 1){

            if(empty($user->phone)){
                return redirect()->back()->withErrors(["message" => "Phone number not available."]);
            }

            $username = "8809601004416";
            $phone = $user->phone;
            $password = (Str::random( 8 )).'@';

            $user->password = Hash::make($password);
            $user->save();

            $message = urlencode("Password reset successfully. new temporary password is ". $password);
            $smsresult = file_get_contents("https://bulksmsbd.net/api/smsapi?api_key=GjKDTrfYuQrhlDA0IOy1&type=text&number=$phone&senderid=$username&message=$message");

            if ($smsresult) {
                return redirect()->back()->with('success', 'New password has been sent to admin phone.');
            } else {
                return redirect()->back()->withErrors(["message" => "SMS sending failed."]);
            }
        }
        return redirect()->back()->withErrors(["message" => "Invalid user"]);
    }

}
