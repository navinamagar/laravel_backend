<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getAddCategory()
    {
        // dd('Hello');
        return view('Admin.Category.Add');
    }

    public function PostAddCategory(Request $request)
    {
        // dd('Hello');
        // dd($request->title);
        $title= $request->title;
        $photo= $request->photo;
        // dd($photo);
        $detail= $request->detail;

        if($photo){     
        // generate unique name for photo
        $time=md5(time()).'.'.$photo->getClientOriginalExtension();
        // to move photo into folder 
        $photo->move('site/uploads/category/',$time);
        // dd($time);
        }
        else{
            $time=Null;
        }
        $categories= new Category; 
        $categories->title=$title;
        $categories->photo=$time;
        $categories->detail=$detail;
        $categories->save();
    }

    public function getManageCategory()
    {

        // dd('Hello');
        // return view('admin.category.manage',['categories'=> category::all()]);
  return view('admin.category.manage',['categories'=> Category::paginate(15)]);
    }

    public function getDeleteCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('getManageCategory');
    }

    public function getEditCategory(Category $category)
    {
        $data=[
            'category'=>$category
        ];
        return view('admin.category.edit',$data);
        
    }

    // public function index()
    // {
    //     return view('admin.Category.manage',['categories'=> Category::all()]);
    // }
}
