<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];



    function order_user()
    {
        return $this->belongsTo(User::class);
    }


    function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    
}
