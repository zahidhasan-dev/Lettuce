<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductSize extends Model
{
    use HasFactory;


    protected $table = 'sizes';
    
    protected $fillable = ['scale_name'];



    public function products(){
        return $this->belongsToMany(Product::class);
    }
    
}
