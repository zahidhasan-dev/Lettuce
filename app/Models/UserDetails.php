<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;


    protected $fillable = ['user_id','phone','city','country'];
    

    function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    function getcountry()
    {
        return $this->hasOne(Country::class,'id','city');
    }

    function getcity()
    {
        return $this->hasOne(City::class,'id','city');
    }

}
