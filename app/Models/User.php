<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'wallet',
        'level',
        'address', 
        'contact_phone', 
        'recipient_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function updateWallet($amount, $operation, $description = null)
    {
        $oldBalance = $this->wallet;
        if ($operation === 'credit') {
            $this->wallet += $amount;
        } else {
            $this->wallet -= $amount;
        }
        $this->save();

        $this->walletHistories()->create([
            'amount' => $amount,
            'balance_after' => $this->wallet,
            'operation' => $operation,
            'description' => $description
        ]);
    }
}
