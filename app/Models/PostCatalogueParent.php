<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCatalogueParent extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id',
        'post_catalogue_parent_name',
        'post_catalogue_parent_description',
        'publish'
    ];
    protected $table = 'post_catalogue_parent';

    public function postCatalogueChildren()
    {
        return $this->hasMany(PostCatalogueChildren::class, 'post_catalogue_parent_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'post_catalogue_parent_id');
    }
}
