<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use App\Helper\JWTToken;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    //
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
                status: 201
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

        // $user = User::where('email', $request->input('email'))->first();
        // if ($user) {

        //     if ($user->password == $request->input('password')) {

        //         return response()->json(
        //             [
        //                 'status' => 'success',
        //                 'message' => 'User login successfully.',
        //                 'data' => $user
        //             ],
        //             status: 200
        //         );
        //     }
        // }

        //email and password check

        // $user = User::where('email', $request->input('email'))->first();

        // if ($user && $user->password == $request->input('password')) {
        //     return response()->json(
        //         [
        //             'status' => 'success',
        //             'message' => 'User login successfully.',
        //             'data' => $user
        //         ],
        //         status: 200
        //     );
        // }


        $user = User::where('email', $request->input('email'))
            ->where('password', $request->input('password'))
            ->count();

        if ($user == 1) {

            //JWT token Issue JWTToken
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'User login successfully.',
                    'token' => $token
                ],
                status: 200
            );
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
            User::where('email', $email)->update(['otp' => $otp]);


            //user Password rest with token Issue
            
            $token = JWTToken::CreateTokenSetPassword($request->input('email'));
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'OTP Verification successfully.',
                    'token' => $token
                ],
                status: 200
            );

            // return response()->json(['status' => 'success', 'message' => 'OTP verified successfully.'], 200);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'OTP verification failed.'], 404);
        }
    }
}
