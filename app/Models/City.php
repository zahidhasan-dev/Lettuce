<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['country_id','city_name'];

    function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }


    function orders()
    {
        return $this->hasMany(\App\Models\Order::class,'billing_city');
    }
}
