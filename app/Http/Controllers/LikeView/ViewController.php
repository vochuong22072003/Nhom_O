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
       
        $postView = PostView::firstWhere('post_id', $postId);
        if ($postView === null) {
            PostView::create([
                'post_id' => $postId,
                'view_count' => 1,
            ]);
        } else {
            $postView->increment('view_count');
        }
    }
   
}
