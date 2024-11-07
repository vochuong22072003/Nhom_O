<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PostView extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'post_views';
    protected $primaryKey = 'post_view_id';
    protected $fillable = [
        'post_id',
        'view_count',
    ];
    public function post()
{
    return $this->belongsTo(Post::class, 'post_id'); // Đảm bảo sử dụng 'post_id', không phải 'posts_id'
}

}
