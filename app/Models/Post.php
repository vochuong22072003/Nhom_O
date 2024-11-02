<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
