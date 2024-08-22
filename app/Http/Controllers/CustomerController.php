<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    function CustomerPage()
    {
        return view('pages.dashboard.customer-page');
    }

    function CustomerList(Request $request)
    {
        $user_id = $request->header('id');
        return  Customer::where('user_id', $user_id)->get();
        // return $customer;

    }

    function CreateCustomer(Request $request)
    {

        $user_id = $request->header('id');
        $customer = Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'user_id' => $user_id,
        ]);

        return $customer;
    }
    function DeleteCustomer(Request $request)
    {
        $user_id = $request->header('id');
        $customerID = $request->input('id');
        $customer = Customer::where('id', $customerID)->where('user_id', $user_id)->delete();
        return $customer;
    }

    function CustomerByID(Request $request)
    {

        $user_id = $request->header('id');
        $customerID = $request->input('id');
        $customer = Customer::where('id', $customerID)->where('user_id', $user_id)->first();
        return $customer;
    }

    function UpdateCustomer(Request $request)
    {

        $user_id = $request->header('id');
        $customerID = $request->input('id');
        return Customer::where('id', $customerID)->where('user_id', $user_id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
        ]);
    }
}
