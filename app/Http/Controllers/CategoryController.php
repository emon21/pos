<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class CategoryController extends Controller
{
    //

    //Category Page Method
    function CategoryPage(){
        return view('pages.dashboard.category-page');
    }

    //All Method
    function CategoryList(Request $request){
        $user_id = $request->header('id');
        $category = Category::where('id',$user_id)->get();
        return $category;
        
    }

    //Create Method
    function CategoryCreate(Request $request){
        $user_id = $request->header('id');
        $category = Category::create([
            'name' =>$request->input('name'),
            'user_id' =>$request->$user_id,
        ]);
        return $category;
    }

    //Edit Method
    function CategoryEdit(Request $request){}


    //Update Method
    function CategoryUpdate(Request $request){
        $userID = $request->header('id');
        $categoryID = $request->input('id');
        return Category::where('id',$categoryID)->where('user_id',$userID)->update([
            'name' =>$request->input('name')
        ]);
    }


    //Delete Method
    function CategoryDelete(Request $request){
        $userID = $request->header('id');
        $categoryID = $request->input('id');
        $category = Category::where('id',$categoryID)->where('user_id',$userID)->delete();
        return $category;
    }
}
