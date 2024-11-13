<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    use HasFactory;

    protected $table = 'customer_info';

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

    /**
     * Return url after "public"
     * Put it inside asset('')
     * @return string
     */
    public function getAvtUrl(): string {
        return 'client/images/' . ($this->cus_avt ?? 'upload/avt-default.png');
    }
    public function getAtrl() {

        return "";
    }

    // relationship
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id', 'cus_id');
    }
}
