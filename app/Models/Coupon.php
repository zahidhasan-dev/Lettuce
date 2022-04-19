<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['coupon_code','coupon_value','coupon_type','coupon_validity'];

    protected $dates = ['coupon_validity'];

}
