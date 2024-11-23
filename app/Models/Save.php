<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Save extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'saves';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    protected $primaryKey = null;
    // public $timestamps = false;

    protected $fillable = [
        'save_folder_id',
        'post_id',
        'cus_id',
    ];
    public function folder()
    {
        return $this->belongsTo(SaveFolder::class, 'save_folder_id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id', 'cus_id');
    }
    public function saves()
    {
        return $this->hasMany(Save::class, 'save_folder_id', 'folder_id');
    }
    
}
