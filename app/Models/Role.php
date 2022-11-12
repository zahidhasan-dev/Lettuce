<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    protected $fillable = ['name','created_at'];



    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


}
