<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Profile;
use App\Models\RejectionHistory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'rol',
        'password',
        'link',
        'validated',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'id');
    }

    public function rejection_histories(): HasMany
    {
        return $this->hasMany(RejectionHistory::class);
    }

    public function payments(): HasMany {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function getLastPaidPaymentAttribute()
    {
        if (! $this->getLastPayment()){
            return 'Inactivo';
        }

        return $this->getLastPayment()->status === 'PAGADO' ? 'Activo' : 'Inactivo';
    }

    public function getLastPayment()
    {
        return $this->payments()->orderBy('created_at', 'desc')->first();
    }

}
