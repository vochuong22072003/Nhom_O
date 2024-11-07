<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SaveFolder extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'save_folders';
    protected $primaryKey = 'folder_id';
    protected $fillable = [
        'folder_name',
        'description',
        'cus_owned',
    ];
   public function saves()
   {
    return $this->hasMany(Save::class,'save_folder_id');
   }
}
