<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Save extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'saves';
    protected $fillable = [
        'save_folder_id',
        'post_id',
        'cus_id',
    ];
}
