<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//related
use App\Models\CusomerInfo;

class Customer extends Authenticatable implements MustVerifyEmail
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

    /**
     * relation customerInfo
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customerInfo()
    {
        return $this->hasOne(CustomerInfo::class, 'cus_id', 'cus_id');
    }

    /**
     * override hasVerifiedEmail of MustVerifyEmail
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->verify_at);
    }

    /**
     * override hasVerifiedEmail of markEmailAsVerified
     * @return void
     */
    public function markEmailAsVerified()
    {
        $this->forceFill([
            'cus_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * override getEmailForVerification of MustVerifyEmail
     * @return mixed
     */
    public function getEmailForVerification()
    {
        return $this->email; 
    }
}
