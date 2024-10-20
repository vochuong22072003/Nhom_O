<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCatalogueChildren extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'post_catalogue_parent_id',
        'post_catalogue_children_id',
        'post_catalogue_children_name',
        'post_catalogue_children_description',
        'publish'
    ];
    protected $table = 'post_catalogue_children';

    public function postCatalogueParent()
    {
        return $this->belongsTo(PostCatalogueParent::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'post_catalogue_children_id');
    }

    
}
