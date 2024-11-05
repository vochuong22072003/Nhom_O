<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PostView extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'posts_view';
    protected $primaryKey = 'view_id';
    protected $fillable = [
        'posts_id',
        'view_count',
    ];
}
