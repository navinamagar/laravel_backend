<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
    public function getAddProduct()
    {
        // dd('Hello');
        return view('Admin.Product.AddProduct');
    }

    public function PostAddProduct(Request $request){
        $catagory= $request->catagory;
        $title= $request->title;
        $cost= $request->cost;
        $detail= $request->detail;
        $image= $request->image;
        $status= $request->status;
        if($image){     
            $time=md5(time()).'.'.$image->getClientOriginalExtension();
            $image->move('site/uploads/product/',$time);
    }
    else{
        $time=Null;
    }
       
        
        $products= new product;
        $products->catagory=$catagory;
        $products->title=$title;
        $products->cost=$cost;
        $products->detail=$detail;
        $products->status=$status;
        $products->image=$time;
        $products->save();
    }
}
