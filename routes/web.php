<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//API Routes

//user-registration
Route::post('user-registration', [UserController::class, 'UserRegistration']);

//user-login
Route::post('user-login', [UserController::class, 'UserLogin']);

//sent otp by email
Route::post('send-otp', [UserController::class, 'SentOTPCode']);
//verify otp
Route::post('verify-otp',[UserController::class,'verifyOTP']);
//Token Verify
Route::post('reset-pass',[UserController::class,'ResetPassword'])->middleware([TokenVerification::class]);

//verify otp
// Route::post('verify-otp', [UserController::class, 'VerifyOTP']);

Route::get('home', [AuthorController::class, 'Home']);

// Page Routes
Route::get('/', [HomeController::class, 'HomePage']);
