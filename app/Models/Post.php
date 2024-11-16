<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PostLike;
use App\Models\PostView;
use App\Models\Tag;
class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'post_id',
        'post_catalogue_parent_id',
        'post_catalogue_children_id',
        'post_name',
        'post_excerpt',
        'image',
        'post_content',
        'user_id',
        'publish'
    ];
    protected $table = 'posts';

    public function postCatalogueParent()
    {
        return $this->belongsTo(PostCatalogueParent::class, 'post_catalogue_parent_id');
    }
    public function postCatalogueChildren()
    {
        return $this->belongsTo(PostCatalogueChildren::class, 'post_catalogue_children_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userInfo()
    {
        return $this->hasOneThrough(UserInfo::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class, 'post_id');
    }
    public function views()
    {
        return $this->hasOne(PostView::class, 'post_id');
    }
    public function likeCount()
    {
        //dem luot thich
        return $this->likes()->count();
    }

    public function viewCount($postId)
    {

        $postview = PostView::firstWhere('post_id', $postId);
        if ($postview === null) {

            $postview = PostView::create([
                'post_id' => $postId,
                'view_count' => 1,
            ]);

        } else {
            $postview->increment('view_count');

        }
        return $postview->view_count;
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'save_folder_id');
    }
    public function isLike()
    {
        $userId = \Auth::guard('customers')->id();
        if (!$userId) {
            return true;
        }
       $hasLiked = PostLike::where('post_id',$this->id)
       ->where('cus_id',$userId)
       ->whereNull('deleted_at')->exists();
        return $hasLiked;
    }

}
