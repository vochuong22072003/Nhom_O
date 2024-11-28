<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'likes_id',
        'post_id',
        'cus_id',
    ];
    protected $table = 'likes';

    public function posts()
    {
        return $this->hasOne(Post::class,'post_id');
    }
    
}
