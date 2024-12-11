<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tokenable_type',
        'tokenable_id',
        'name',
        'token',
        'abilities',
        'last_used_at',
        'expires_at',
        'created_at',
        'updated_at'
    ];

    protected $table ='personal_access_tokens';

    public function user()
    {
        return $this->belongsTo(User::class, 'tokenable_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'tokenable_id');
    }
}
