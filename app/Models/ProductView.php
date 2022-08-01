<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
    use HasFactory;

    protected $fillable = ['user_ip','user_id','product_id'];


    public function product(){
        return $this->belongsTo(Product::class);
    }

    
}
