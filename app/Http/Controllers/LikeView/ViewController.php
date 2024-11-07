<?php

namespace App\Http\Controllers\LikeView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostView;
use App\Models\Post;
class ViewController extends Controller
{
    public function show($encryptedId)
    {
        // Giải mã encrypted_id nếu cần
        $postId = decrypt($encryptedId);

        // Lấy bài viết từ cơ sở dữ liệu
        $getPost = Post::findOrFail($postId);
        $this->incrementViewCount($postId);
        $viewCount = $getPost->viewCount($postId);
        return view('posts.show', [
            'post' => $getPost,
            'viewCount' =>$viewCount,
        ]);
    }
    protected function incrementViewCount($postId)
    {
        $postview  = PostView::firstWhere('post_id',$postId);
        if ($postview === null )
        {
             PostView::create([
                'post_id' => $postId,
                'view_count' => 1
            ]);
        } 
        else {
            $postview->increment('view_count');
        }
    }
    
}
