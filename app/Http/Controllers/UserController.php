<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

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

            //JWT token Issue
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
}
