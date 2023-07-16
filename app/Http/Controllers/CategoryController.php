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
        $detail= $request->detail;
        $go= new Category;
        $go->title=$title;
        $go->photo=$photo;
        $go->detail=$detail;
        $go->save();
    }
}
