<?php

namespace App\Http\Controllers\LikeView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
class PostTagController extends Controller
{
    public function addTagsPost($request, $postId)
    {
        $post = Post::findOrFail($postId);
        $tagIds = $request->input('tag_ids');

        // gan tag vao bai viet
        $post->tags()->syncWithoutDetaching($tagIds);
    }
    // Lấy danh sách tags của một bài viết
    public function getPostTags($postId)
    {
        $post = Post::with('tags')->findOrFail($postId);

        return response()->json($post->tags);
    }
    // Xóa tag khỏi một bài viết
    public function removeTagFromPost($postId, $tagId)
    {
        $post = Post::findOrFail($postId);

        // Xóa tag khỏi bài viết
        $post->tags()->detach($tagId);

        return response()->json(['message' => 'Tag removed from post successfully']);
    }
    
}
