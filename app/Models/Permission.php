<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;


    protected $fillable = ['name','created_at'];



    public function users()
    {
        return $this->belongsToMany(Permission::class);
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }



}
