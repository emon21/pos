<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
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
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'DashboardPage'])->middleware(TokenVerification::class);
//ProfilePage
Route::get('/userProfile', [UserController::class, 'ProfilePage'])->middleware(TokenVerification::class);
// //UpdateProfile
// Route::get('/updateProfile', [UserController::class, 'UpdateProfilePage'])->middleware(TokenVerification::class);




//Category
Route::get('/categoryPage', [CategoryController::class, 'CategoryPage'])->middleware(TokenVerification::class);
//Customer
Route::get('/customerPage', [CustomerController::class, 'CustomerPage'])->middleware(TokenVerification::class);
//Product
Route::get('/productPage', [ProductController::class, 'ProductPage'])->middleware(TokenVerification::class);
//Invoice
Route::get('/invoicePage', [InvoiceController::class, 'InvoicePage'])->middleware(TokenVerification::class);
//Sale
Route::get('/salePage', [InvoiceController::class, 'SalePage'])->middleware(TokenVerification::class);
//Report
Route::get('/reportPage', [ReportController::class, 'ReportPage'])->middleware([TokenVerification::class]);


# // Category Route API//
Route::post('/create-category', [CategoryController::class, 'CategoryCreate'])->middleware(TokenVerification::class);
Route::get('/list-category', [CategoryController::class, 'CategoryList'])->middleware(TokenVerification::class);
Route::post('/delete-category', [CategoryController::class, 'CategoryDelete'])->middleware(TokenVerification::class);
Route::post('/category-by-id', [CategoryController::class, 'CategoryByID'])->middleware(TokenVerification::class);
Route::post('/update-category', [CategoryController::class, 'CategoryUpdate'])->middleware(TokenVerification::class);

# //Customer API Route
Route::get('/list-customer', [CustomerController::class, 'CustomerList'])->middleware(TokenVerification::class);
Route::post('/create-customer', [CustomerController::class, 'CreateCustomer'])->middleware(TokenVerification::class);
Route::post('/delete-customer', [CustomerController::class, 'DeleteCustomer'])->middleware(TokenVerification::class);
Route::post('/customer-by-id', [CustomerController::class, 'CustomerByID'])->middleware(TokenVerification::class);
Route::post('/update-customer', [CustomerController::class, 'UpdateCustomer'])->middleware(TokenVerification::class);


# // Product API Route
Route::get('product-list', [ProductController::class, 'ProductList'])->middleware(TokenVerification::class);
Route::post('create-product', [ProductController::class, 'CreateProduct'])->middleware(TokenVerification::class);
Route::post('delete-product', [ProductController::class, 'DeleteProduct'])->middleware(TokenVerification::class);
Route::post('product-by-id', [ProductController::class, 'ProductByID'])->middleware(TokenVerification::class);
Route::post('update-product', [ProductController::class, 'UpdateProduct'])->middleware(TokenVerification::class);
//show product by category
Route::get('show-product-by-category', [ProductController::class, 'ShowProductByCategory'])->middleware(TokenVerification::class);

//single product
Route::post('single-product', [ProductController::class, 'SingleProduct'])->middleware(TokenVerification::class);

// Invoice API Route
Route::post('invoice-create', [InvoiceController::class, 'InvoiceCreate'])->middleware(TokenVerification::class);
Route::get('invoice-select', [InvoiceController::class, 'InvoiceSelect'])->middleware(TokenVerification::class);

//invoice details
Route::post('invoice-details', [InvoiceController::class, 'InvoiceDetails'])->middleware(TokenVerification::class);
Route::post('invoice-delete', [InvoiceController::class, 'InvoiceDelete'])->middleware(TokenVerification::class);


// SUMMARY & Report

Route::get('summary', [DashboardController::class, 'summary'])->middleware(TokenVerification::class);

Route::get("/sales-report/{FormDate}/{ToDate}", [ReportController::class, 'SalesReport'])->middleware([TokenVerification::class]);
