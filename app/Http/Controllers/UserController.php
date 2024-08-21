<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use App\Helper\JWTToken;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    //
    function RegistrationPage()
    {
        return view('pages.auth.registration-page');
    }
    function LoginPage()
    {
        return view('pages.auth.login-page');
    }
    function SentOTPPage()
    {
        return view('pages.auth.send-otp-page');
    }
    function verifyOtpPage()
    {
        return view('pages.auth.verify-otp-page');
    }
    function ResetPasswordPage()
    {
        return view('pages.auth.reset-pass-page');
    }

    //profile

    function ProfilePage()
    {
        return view('pages.dashboard.profile-page');
    }


    function UserRegistration(Request $request)
    {
        try {

            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'mobile' => $request->input('mobile'),
            ]);

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'User created successfully.'
                ],
                status: 200
            );
        } catch (Exception $ex) {

            return response()->json(
                [
                    'status' => 'failed',
                    'message' => 'User created Failed.'
                    // 'message' => $ex->getMessage()
                ],
                status: 403
            );
        }
    }

    function UserLogin(Request $request)
    {
        $user = User::where('email', $request->input('email'))
            ->where('password', $request->input('password'))
            ->select('id')->first();
        if ($user !== null) {

            //JWT token Issue JWTToken
            $token = JWTToken::CreateToken($request->input('email'), $user->id);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'User login successfully.',
                    // 'token' => $token
                ],
                status: 200
            )->cookie('token', $token, 60 * 24 * 30);
        } else {

            return response()->json(
                [
                    'status' => 'failed',
                    'message' => 'unauthorized',
                ],
                status: 403
            );
        }
    }

    function SentOTPCode(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $count = User::where('email', $email)->count();

        if ($count == 1) {
            //OTP Code
            Mail::to($email)->send(new OTPMail($otp));
            // $user->otp = $otp;
            //otp code table update
            $user = User::where('email', $email)->update(['otp' => $otp]);
            // $user->save();
            return response()->json([
                'status' => 'success',
                'message' => "Your OTP Code is  {{ $otp }} has been sent by Email."
            ], 200);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Email not found'], 404);
        }
    }

    function verifyOTP(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', $email)->where('otp', $otp)->count();
        if ($count == 1) {
            //Database OTP update
            User::where('email', $email)->update(['otp' => 0]);
            //user Password rest with token Issue
            $token = JWTToken::CreateTokenSetPassword($request->input('email'));
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'OTP Verification successfully.',

                ],
                status: 200
            )->cookie('token', $token, 60 * 24 * 30);


            // return response()->json(['status' => 'success', 'message' => 'OTP verified successfully.'], 200);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'OTP verification failed.'], 404);
        }
    }

    function ResetPassword(Request $request)
    {

        try {

            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successfully'
            ], status: 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went Wrong',
            ], status: 401);
        }
    }

    //UserLogout
    function UserLogout()
    {

        // $request->session()->invalidate();
        return redirect('/userLogin')->cookie('token', '', -1);
    }

    function UserProfile(Request $request) {

        $email = $request->header('email');
        $user = User::where('email', $email)->first();
        return response()->json([
            'status' => 'success',
            'data' => $user
        ], status: 200);
    }

    function UpdateProfile(Request $request) {

        try{

            $email = $request->header('email');
            $user = User::where('email', $email)->first();
            $user->firstName = $request->input('firstName');
            $user->lastName = $request->input('lastName');
            // $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->mobile = $request->input('mobile');
            $user->save();

            // User::where('email', $email)->update([
            //     'otp' => 0,
            //     'firstName' => $firstName,
            //     'lastName' => $lastName,
            //     'password' => $password,
            //     'mobile' => $mobile
            // ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Request Successfully'
            ], status: 200);
        }catch(Exception $ex){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something went Wrong',
            ], status: 200);
        }
      
}
}