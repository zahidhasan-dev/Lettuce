<?php

namespace App\Models;

use App\Traits\HasPermissions;
use App\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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



    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin') === true;
    }



    function userDetails()
    {
        return $this->hasOne(UserDetails::class,'user_id');
    }



    function orders()
    {
        return $this->hasMany(Order::class);
    }


    function ordered_products()
    {
        return $this->hasManyThrough(OrderItem::class,Order::class,'user_id','order_id');
    }



    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }


    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class);
    // }





}
