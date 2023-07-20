<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
class GalleryController extends Controller
{
    public function getAddGallery()
    {
        // dd('Hello');
        return view('Admin.Gallery.AddGallery');
    }

    public function PostAddGallery(Request $request)
    {
        // dd('Hello');
        // dd($request->title);
        $title= $request->title;
        $photo= $request->photo;
        // dd($photo);

        if($photo){     
            $time=md5(time()).'.'.$photo->getClientOriginalExtension();
            $photo->move('site/uploads/gallery/',$time);
    }
    else{
        $time=Null;
    }
    $gallery= new gallery; 
    $gallery->title=$title;
    $gallery->photo=$time;
    $gallery->save();
}
}
