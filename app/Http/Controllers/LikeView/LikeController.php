<?php

namespace App\Http\Controllers\LikeView;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostLike;

class LikeController extends Controller
{
 
     public function getLike(Request $request)
     {
        $post_id = $request->input('post_id');
        $cus_id = auth()->id();
        if (!$cus_id)
        {
            return redirect()->back()->with('error', 'bạn cần đăng nhập để thực hiện thao tác này');
        }
        $existinglike = PostLike::withTrashed()->where('post_id', $post_id)
        ->where('cus_id',$cus_id)
        ->first();
        
        if($existinglike && is_null($existinglike->deleted_at))
        {
            // check if do not like 

            $existinglike->delete();
            return response()->json(['status' => 'liked']);
        }    
        else if(is_null($existinglike))
        {
            
            PostLike::firstOrCreate([
                'post_id' => $post_id,
                'cus_id' => $cus_id,    
            ]);
            return response()->json(['status' => 'unliked']);
        }
        else 
        {
            // if do not like , will add like
            $existinglike->restore();
            return response()->json(['status' => 'unliked']);
        } 
    }
    public function getLikedPosts()
    {
        $cus_id = auth()->id();
        if (!$cus_id) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem các bài viết đã thích.');
        }
        $likedPosts = PostLike::with('post')->where('cus_id',$cus_id)->whereNull('deleted_at')->get()->pluck('post');
        return view('client.myactive', compact('likedPosts'));  
    }

     
} 
