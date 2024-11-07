<?php

namespace App\Http\Controllers\LikeView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostLike;
class LikeController extends Controller
{
 
     public function getLike(Request $request)
     {
        $post_id = $request->input('post_id');
        $cus_id = $request->input('cus_id');
        $existinglike = PostLike::where('post_id' , $post_id)->where('cus_id',$cus_id)->first();
        if($existinglike)
        {
            // check if do not like 
            $existinglike->delete();

        }
        else
        {
            // if do not like , will add like
           PostLike::create([
                'post_id' => $post_id,
                'cus_id' => $cus_id,
            ]);
            
        }
    }
     public function postLiked($cus_id)
     {
        $likedPosts = PostLike::where('cus_id', $cus_id)->with('post')->get();
       return view('posts.liked',compact('likedPosts'));
     }
        
     
} 
