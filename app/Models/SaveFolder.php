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
    public $incrementing = true;
    protected $fillable = [
        'folder_name',
        'description',
        'cus_owned',
    ];
   public function saves()
   {
    return $this->hasMany(Save::class,'save_folder_id', 'folder_id');
   }
   public function saveFolders()
    {
        return $this->hasMany(SaveFolder::class, 'cus_owned');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_owned');
    }
    public function isSave($postId,$folderId ,$cusId = null)
      {
        if (is_null($cusId)) {
            $cusId = \Auth::guard('customers')->user()->cus_id;
        }
      $save =  Save::where('post_id', $postId)
        ->where('save_folder_id',   $folderId)
        ->where('cus_id', $cusId)->get();
        return ($save->isEmpty() ? false : true);
      }
      
}
