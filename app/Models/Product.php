<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['product_name','product_desc','price','stock','thumbnail','slug','created_at'];


    public function size(){
        // return $this->belongsTo(ProductSize::class)->withPivot('size_value');
        return $this->belongsToMany(ProductSize::class)->withPivot('size_value');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function multiple_photos(){
        return $this->hasMany(ProductMultiplePhoto::class);
    }

}
