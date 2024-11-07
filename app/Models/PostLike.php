<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Post;
class PostLike extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'likes';
    protected $fillable = 
    [
        'post_id',
        'cus_id',
    ];
    public function post()
    {
        return $this->belongsTo(Post::class,'id');
    }
}
