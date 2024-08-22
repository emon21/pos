<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class CategoryController extends Controller
{
    //

    //Category Page Method
    function CategoryPage()
    {
        return view('pages.dashboard.category-page');
    }

    //All Method
    function CategoryList(Request $request)
    {
        $user_id = $request->header('id');
        $category = Category::with('user')->where('user_id', $user_id)->get();
        return $category;
    }

    //Create Method
    function CategoryCreate(Request $request)
    {
        $user_id = $request->header('id');
        $category = Category::create([
            'name' => $request->input('name'),
            'user_id' => $user_id,
        ]);
        return $category;
    }

    // function CategoryCreate(Request $request){
    //     $user_id=$request->header('id');
    //     return Category::create([
    //         'name'=>$request->input('name'),
    //         'user_id'=>$user_id
    //     ]);
    // }

    //Edit Method
    function CategoryEdit(Request $request) {}

    //Delete Method
    function CategoryByID(Request $request)
    {

        $user_id = $request->header('id');
        $categoryID = $request->input('id');
        $category = Category::where('id', $categoryID)->where('user_id', $user_id)->first();
        return $category;
    }

    //Update Method
    function CategoryUpdate(Request $request)
    {
        $user_id = $request->header('id');
        $categoryID = $request->input('id');
        return Category::where('id', $categoryID)->where('user_id', $user_id)->update([
            'name' => $request->input('name')
        ]);
    }


    //Delete Method
    function CategoryDelete(Request $request)
    {
        $user_id = $request->header('id');
        $categoryID = $request->input('id');
        $category = Category::where('id', $categoryID)->where('user_id', $user_id)->delete();
        return $category;
    }
}
