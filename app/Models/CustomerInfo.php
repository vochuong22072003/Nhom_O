<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    use HasFactory;

    protected $table = 'customers_info';

    // Khai báo khóa chính
    protected $primaryKey = 'cus_id';

    protected $fillable = [
        'cus_id',   // Khóa ngoại từ bảng customers
        'cus_name',
        'birth_date',
        'cus_phone',
        'address',
        'gender',
        'cus_avt',
    ];

    // relationship
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id', 'cus_id');
    }
    public function likes()
    {
        return $this->hasMany(PostLike::class,'cus_id');
    }
}
