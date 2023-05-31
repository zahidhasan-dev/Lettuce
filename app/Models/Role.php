<?php

namespace App\Models;

use App\Contracts\Role as RoleContract;
use App\Traits\HasPermissions;
use App\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model implements RoleContract
{
    use HasFactory, HasPermissions;


    protected $fillable = ['name','created_at'];



    public function users(): BelongsToMany 
    {
        return $this->belongsToMany(User::class);
    }


    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }


    public static function findByName(string $name): RoleContract
    {   
        $role = static::query()->where('name',$name)->first();

        if(! $role){
            abort(400,"There is no role named `{$name}`.");
        }

        return $role;
    }


    public static function findById(int $id): RoleContract
    {
        $role = static::query()->where('id',$id)->first();

        if(! $role){
            abort(400,"There is no [role] with id `{$id}`.");
        }

        return $role;
    }


    public function hasPermissionTo($permission): bool
    {
        $permissionClass = $this->getPermissionClass();
        
        if(is_string($permission)){
          $permission = $permissionClass->findByName($permission);
        }

        if(is_int($permission)){
            $permission = $permissionClass->findById($permission);
        }

        return $this->permissions->contains('id',$permission->id);
    }


}
