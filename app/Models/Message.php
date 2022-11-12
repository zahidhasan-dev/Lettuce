<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['message_id','name','email','message','created_at'];


    public function replies()
    {
        return $this->hasMany(Message::class,'message_id');
    }

}
