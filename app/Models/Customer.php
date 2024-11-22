<?php

namespace App\Models;

use App\Mail\NewPostEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;

class Customer extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, SoftDeletes, Notifiable;

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
    protected $hidden = 'cus_pass';

    protected $dates = ['deleted_at'];

    public function getAuthPassword()
    {
        return $this->cus_pass;
    }
    public function hasVerifiedEmail()
    {
        return !is_null($this->verify_at);
    }
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'verify_at' => $this->freshTimestamp(),
        ])->save();
    }
    public function getEmailVerifiedAtColumn()
    {
        return 'verify_at';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customerInfo()
    {
        return $this->hasOne(CustomerInfo::class, 'cus_id', 'cus_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saveFolders()
    {

        return $this->hasMany(SaveFolder::class, 'cus_owned');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'cus_id', 'user_id');
    }
}
