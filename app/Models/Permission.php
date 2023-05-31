<?php

namespace App\Models;

use App\Contracts\Permission as PermissionContract;
use App\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model implements PermissionContract
{
    use HasFactory, HasRoles;


    protected $fillable = ['name','created_at'];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }


    public static function findById(int $id): PermissionContract
    {
        $permission = static::query()->where('id',$id)->first();

        if(! $permission){
            abort(400,"There is no [permission] with id `{$id}`.");
        }

        return $permission;
    }
    
    
    public static function findByName(string $name): PermissionContract
    {
        $permission = static::query()->where('name',$name)->first();

        if(! $permission){
            abort(400,"There is no permission named `{$name}`.");
        }

        return $permission;
    }



}
