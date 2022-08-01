<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;


    protected $fillable = ['discount_name','discount_value','discount_type','discount_slug','discount_validity'];


    public function discount_products()
    {
        return $this->hasMany(ProductDiscount::class);
    }


    // public function products()
    // {
    //     return $this->hasManyThrough(Product::class, ProductDiscount::class, 'discount_id','id','id','product_id');
    // }


    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    
}
