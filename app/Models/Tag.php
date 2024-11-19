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
        'tag_name',
        
    ];
    public function posts()
    {
        return $this->belongsToMany(Post::class , 'post_tags','tag_id','post_id'); 
    }
    
}
