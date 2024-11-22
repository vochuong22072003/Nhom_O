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
    public $incrementing = false;
    public $timestamps = false;
    protected $casts = [
        'birth_date' => 'datetime',
    ];

    protected $guard = 'cus_id';
    protected $fillable = [
        'cus_id', 
        'cus_name',
        'birth_date',
        'cus_phone',
        'address',
        'gender',
        'cus_avt',
    ];
    public static function getEnumGenders()
    {
        $type = \DB::selectOne("SHOW COLUMNS FROM customer_info WHERE Field = ?", ['gender'])->Type;

        preg_match("/^enum\((.*)\)$/", $type, $matches);

        if (isset($matches[1])) {
            // Tách các giá trị ENUM và loại bỏ dấu nháy đơn
            return array_map(function ($value) {
                return trim($value, "'");
            }, explode(',', $matches[1]));
        }

        return [];
    }
    /**
     * Return url of avatar
     * Just put it in src:
     * @return string
     */
    public function getAvtUrl(): string
    {
        if (!empty($this->cus_avt)) {
            return \Storage::disk('upload')->url($this->cus_avt);
        }
        return asset('client/images/upload/avt-default.png');
    }
    public function getAtrl()
    {

        return "";
    }

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
