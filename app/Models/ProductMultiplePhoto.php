<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMultiplePhoto extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','multiple_photo'];
    


    public function product(){
        return $this->belongsTo(Product::class);
    }
}
