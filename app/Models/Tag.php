<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $primaryKey = 'tag_id';
    protected $fillable = [
        'tag_id',
        'tag_name',
        'description',
    ];
    public function posts()
    {
        return $this->belongsToMany(Post::class , 'post_tags','tag_id','post_id'); 
    }
    public function addTag($postId,Request $request)
    {
        $tagName = $request->input('tag_name');
        $add = Save::create([
            'tag_id' => $postId,
            'post_id' => $postId,
            'tag_name' => $tagName,
        ]);
        return $add;
    }
}
