<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $primaryKey = 'tag_id';
    protected $fillable = [
        'tag_name',
        'description',
    ];
    public function posts()
    {
        // thiet lap quan he nhieu nhieu voi Post

        return $this->belongsToMany(Post::class , 'post_tags','tag_id','post_id'); 
    }
}
