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
        $cus_id = auth()->id();
        if (!$cus_id)
        {
            return response()->json(['error' => 'Bạn cần đăng nhập để thực hiện thao tác này.'], 403);
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
     
} 
