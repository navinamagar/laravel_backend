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

public function getProductTable()
{
    return view ('Admin.Product.ProductTable',['products'=> product::paginate(15)]);
}

public function getDeleteProduct(product $product)
{
    $product->delete();
    return redirect()->route('getProductTable');
}

public function getEditProduct(product $product)
{
    $data=['product'=> $product];
    return view ('Admin.Product.EditProduct',$data);
}

public function postEditProduct (Request $request,Product $product)
{
    $photo= $request->file('image');
   

        if($photo){   
            $time=md5(time()).'.'.$photo->getClientOriginalExtension();
            $photo->move('site/uploads/product/',$time);

            $product->catagory=$request->input('catagory');
            $product->title=$request->input('title');
            $product->detail=$request->input('detail');
            $product->cost=$request->input('cost');
            $product->image=$time;
            $product->save();
            }
            else{
                $product->catagory=$request->input('catagory');
                $product->title=$request->input('title');
                $product->detail=$request->input('detail');
                $product->cost=$request->input('cost');
                $product->save();
        }
        return redirect()->route('getProductTable');
}
}
