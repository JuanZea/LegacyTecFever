<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property mixed isAdmin
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'document', 'document_type', 'mobile', 'email', 'password', 'is_enabled', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Functions

    /**
     * Indicates if a user has pending payments
    */
    public function pendingpayment(): bool
    {
        $payments = $this->payments->where('status','PENDING');
        $payments = $payments->merge($this->payments->where('status','OK'));
        return count($payments) != 0;
    }

    /**
     * Indicates if a user has payments history that are not pending
    */
    public function hasHistory(): bool
    {
        return count($this->payments->where('status', '!=', 'PENDING')) != 0;
    }

    // Reltaions

    public function shoppingCart(): HasOne
    {
        return $this->hasOne(ShoppingCart::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
