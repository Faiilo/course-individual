<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
{
    return $this->is_admin == 1;
}

    // 👇 ДОБАВЬ ЭТОТ МЕТОД
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'id_subscription');
    }

    // 👇 ДОБАВЬ ЭТОТ МЕТОД
    public function hasActiveSubscription()
{
    return $this->id_subscription && 
           $this->subscription && 
           $this->subscription->status === 'Активна';
}
}