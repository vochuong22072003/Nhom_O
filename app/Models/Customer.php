<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
//related
use App\Models\CusomerInfo;

class Customer extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';
    protected $primaryKey = 'cus_id';

    protected $fillable = [
        'cus_user',
        'cus_pass',
        'email',
        'verify_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    public function getAuthPassword()
    {
        return $this->cus_pass;
    }

    //relationship
    public function customerInfo()
    {
        return $this->hasOne(CustomerInfo::class, 'cus_id', 'cus_id');
    }
}
