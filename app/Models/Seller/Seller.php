<?php

namespace App\Models\Seller;

use App\Notifications\Seller\SellerEmailVerifyNotification;
use App\Notifications\Seller\SellerResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Seller extends Authenticatable implements  MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,SoftDeletes;

    protected $guard = 'seller';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function sendEmailVerificationNotification()
    {
        $this->notify(new SellerEmailVerifyNotification());
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SellerResetPasswordNotification($token));
    }

    protected $fillable = [
        'name',
        'email',
        'image',
        'phone_number',
        'password',
        'dob',
        'code',
        'email_verified_at'
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
    ];
}
