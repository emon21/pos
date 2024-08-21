<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
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
Route::post('verify-otp', [UserController::class, 'verifyOTP']);
//Token Verify
Route::post('reset-password', [UserController::class, 'ResetPassword'])->middleware([TokenVerification::class]);
//logout
Route::get('user-logout', [UserController::class, 'UserLogout']);
//profile
// Route::get('user-profile', [UserController::class, 'UserLogout']);

Route::get('user-profile', [UserController::class, 'UserProfile'])->middleware(TokenVerification::class);
Route::post('update-profile', [UserController::class, 'UpdateProfile'])->middleware(TokenVerification::class);



// Page Routes
Route::get('/', [HomeController::class, 'HomePage']);
//user-registration
Route::get('userRegistration', [UserController::class, 'RegistrationPage']);
//user-login
Route::get('userLogin', [UserController::class, 'LoginPage']);
//sent otp by email
Route::get('sendOtp', [UserController::class, 'SentOTPPage']);
//verify otp
Route::get('verifyOtp', [UserController::class, 'verifyOtpPage']);
//Token Verify
Route::get('resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware(TokenVerification::class);
//dashboard
Route::get('/dashboard', [HomeController::class, 'DashboardPage'])->middleware(TokenVerification::class);
//ProfilePage
Route::get('userProfile', [UserController::class, 'ProfilePage'])->middleware(TokenVerification::class);


# // Category Route  API//
Route::post('create-category',[CategoryController::class,'CategoryCreate'])->middleware(TokenVerification::class);
Route::get('list-category',[CategoryController::class,'CategoryList'])->middleware(TokenVerification::class);
Route::post('delete-category',[CategoryController::class,'CategoryDelete'])->middleware(TokenVerification::class);
Route::post('update-category',[CategoryController::class,'CategoryUpdate'])->middleware(TokenVerification::class);
