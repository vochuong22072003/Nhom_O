<?php

namespace App\Http\Controllers\LikeView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostView;
class ViewController extends Controller
{
    public function show($postId)
    {
       
        $postView = PostView::where('posts_id', $postId)->first();

        if (!$postView) {
            $postView = new PostView();
            $postView->posts_id = $postId;
            $postView->view_count = 1;
            $postView->save();
        } else {
            
            $postView->increment('view_count');
        }

     
        return view('posts.show', [
            'postId' => $postId,
            'viewCount' => $postView->view_count,
        ]);
    }
}
