<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //
    function productPage()
    {
        return view('pages.dashboard.product-page');
    }

    function ProductList(Request $request)
    {
        $user_id = $request->header('id');
        $product = Product::where('user_id', $user_id)->get();
        return $product;
    }

    function CreateProduct(Request $request)
    {
        $user_id = $request->header('id');

        //Prepare File name && Path Image
        $img = $request->file('img');
        $time = Time();
        $file_name = $img->getClientOriginalExtension();
        // $file_name = $time . $file_name.'.' . $img->getClientOriginalExtension();

        $img_name = $time . '.' . $file_name;

        $img_url = "uploads/{$img_name}";

        //upload
        $img->move(public_path('uploads'), $img_name);

        //Save Database
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'img_url' => $img_url,
            'category_id' => $request->input('category_id'),
            'user_id' => $user_id,
        ]);
        return $product;
    }

    function DeleteProduct(Request $request)
    {

        //Delete img
        $user_id = $request->header('id');
        $productID = $request->input('id');

        //delete img path
        $file_path = $request->input('file_path');
        unlink(public_path($file_path));
        // File::delete($file_path);

        // $product = Product::where('id', $productID)->where('user_id', $user_id)->first();
        // $img_url = $product->img_url;
        // unlink(public_path($file_path));
        // $product->delete();

        //delete img path
        // $product = Product::where('id', $productID)->where('user_id', $user_id)->delete();
        // return $product;


        //Delete Database
        // $productID = $request->input('id');
        $product = Product::where('id', $productID)->where('user_id', $user_id)->delete();
        return $product;
    }

    function ProductByID(Request $request)
    {
        $user_id = $request->header('id');
        $product_id = $request->input('id');
        return Product::where('id', $product_id)->where('user_id', $user_id)->first();
    }

    function UpdateProduct(Request $request)
    {
        $user_id = $request->header('id');
        $product_id = $request->input('id');

        //file check
        // $img = $request->file('img');
        // if($img != null) {
        //     $time = Time();
        //     $file_name = $img->getClientOriginalExtension();
        //     $img_name = $time .'.'. $file_name;
        //     $img_url = "uploads/{$img_name}";
        //     $img->move(public_path('uploads'), $img_name);
        //     $product = Product::where('id', $product_id)->where('user_id', $user_id)->update([
        //         'name' => $request->input('name'),
        //         'price' => $request->input('price'),
        //         'unit' => $request->input('unit'),
        //         'img_url' => $img_url,
        //         'category_id' => $request->input('category_id'),
        //     ]);
        //     return $product;
        // } else {
        //     $product = Product::where('id', $product_id)->where('user_id', $user_id)->update([
        //         'name' => $request->input('name'),
        //         'price' => $request->input('price'),
        //         'unit' => $request->input('unit'),
        //         'category_id' => $request->input('category_id'),
        //     ]);
        //     return $product;
        // }

        // $img = $request->hasFile('img');

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $time = Time();
            $file_name = $img->getClientOriginalExtension();
            $img_name = $time . '.' . $file_name;
            $img_url = "uploads/{$img_name}";
            $img->move(public_path('uploads'), $img_name);

            //Delete OLD File
            // $product = Product::where('id', $product_id)->where('user_id', $user_id)->first();
            $old_img_url = $request->input('file_path');
            unlink(public_path($old_img_url));
            // File::delete($old_img_url);

            //Update Product
            $product = Product::where('id', $product_id)->where('user_id', $user_id)->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'img_url' => $img_url,
                'category_id' => $request->input('category_id'),
            ]);
            return $product;
        } else {
        }
        $product = Product::where('id', $product_id)->where('user_id', $user_id)->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'category_id' => $request->input('category_id'),
        ]);
        return $product;
    }

    //ShowProductByCategory
    function ShowProductByCategory(Request $request)
    {
        $user_id = $request->header('id');
        $category_id = $request->input('id');
        return Product::where('category_id', $category_id)->where('user_id', $user_id)->get();
    }

    // SingleProduct
    function SingleProduct(Request $request)
    {
        $user_id = $request->header('id');
        $product_id = $request->input('id');
        return Product::where('id', $product_id)->where('user_id', $user_id)->first();
    }
}
