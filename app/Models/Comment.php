<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'post_id',
        'customer_id',
        'content',
        'publish',
        'parent_id'
    ];

    protected $table ='comments';
  
    public function customers(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function posts(){
        return $this->belongsTo(Post::class, 'post_id');
    }
}
