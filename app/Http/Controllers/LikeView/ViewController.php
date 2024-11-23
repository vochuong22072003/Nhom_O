<?php

namespace App\Http\Controllers\LikeView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostView;
use App\Models\SaveFolder;
use App\Models\Post;
class ViewController extends Controller
{
    
    protected function incrementViewCount($postId)
    {
       
        $postViewCount = PostView::viewCount($postId);
        return response()->json(['view_count' => $postViewCount]);
    }
   
}
