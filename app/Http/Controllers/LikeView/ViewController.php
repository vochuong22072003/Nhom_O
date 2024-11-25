<?php

namespace App\Http\Controllers\LikeView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostView;
use App\Models\SaveFolder;
use App\Models\Post;
class ViewController extends Controller
{
    
    public function incrementViewCount(Request $request)
    { 
        $post_id = $request->post_id;
         $post = Post::find($post_id);
        return response()->json([
            'view_count' => $post->viewCount($post_id),
        ]);
    }
}
