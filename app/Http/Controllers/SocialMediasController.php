<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialMedias;

class SocialMediasController extends Controller
{
    public function getSocialMedia()
    {
        return view ('admin.socialmedia.media');
    }
    public function PostSocialMedia(Request $request){
        $SocialMediaName= $request->SocialMediaName;
        $SocialMediaLink= $request->SocialMediaLink;
        $SocialMediaIcon= $request->SocialMediaIcon;
        if($SocialMediaIcon){     
            // generate unique name for photo
            $time=md5(time()).'.'.$SocialMediaIcon->getClientOriginalExtension();
            // to move photo into folder 
            $SocialMediaIcon->move('site/uploads/socialmedia/',$time);
            // dd($time);
            }
            else{
                $time=Null;
            }
            $Social_Medias= new SocialMedias;
            $Social_Medias->SocialMediaName=$SocialMediaName;
            $Social_Medias->SocialMediaLink=$SocialMediaLink;
            $Social_Medias->SocialMediaIcon=$time;
            $Social_Medias->save();
            
    }
}
