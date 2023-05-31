<?php 

namespace App\Traits;

use App\Contracts\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissions
{


    private $permissionClass = \App\Models\Permission::class;


    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany($this->permissionClass);
    }



    public function getPermissionClass()
    {
        return  app($this->permissionClass);
    }



    public function hasPermissionTo($permission)
    {
        $permissionClass = $this->getPermissionClass();
        
        if(is_string($permission)){
          $permission = $permissionClass->findByName($permission);
        }

        if(is_int($permission)){
            $permission = $permissionClass->findById($permission);
        }

        if(! $permission instanceof Permission){
            return false;
        }

        return $this->hasDirectPermission($permission) || $this->hasPermissionViaRole($permission);
    }



    public function hasAnyPermission(...$permissions)
    {
        $permissions = collect($permissions)->flatten();

        foreach ($permissions as $permission) {
            if($this->hasPermissionTo($permission)){
                return true;
            }
        }

        return false;
    }



    public function hasAllPermissions(...$permissions)
    {
        $permissions = collect($permissions)->flatten();

        foreach ($permissions as $permission) {
            if(! $this->hasPermissionTo($permission)){
                return false;
            }
        }

        return true;
    }



    public function hasPermissionViaRole(Permission $permission)
    {
        return $this->hasRole($permission->roles);
    }



    public function hasDirectPermission($permission)
    {   
        $permissionClass = $this->getPermissionClass();

        if(is_string($permission)){
            $permission = $permissionClass->findByName($permission);
        }

        if(is_int($permission)){
            $permission = $permissionClass->findById($permission);
        }

        if(! $permission instanceof Permission){
            return false;
        }
        
        return $this->permissions->contains($permission->getKeyName(),$permission->getKey());
    }



    public function getPermissionsViaRoles()
    {
        return $this->loadMissing('roles', 'roles.permissions')
                    ->roles->flatMap(function ($role) {
                        return $role->permissions;
                    })->sort()->values();
    }


    
    public function getAllPermissions()
    {
        $permissions = $this->permissions;

        if($this->roles){
            $permissions = $permissions->merge($this->getPermissionsViaRoles());
        }

        return $permissions->sort()->values();
    }



    public function getStoredPermissions($permissions)
    {
        $permissionClass = $this->getPermissionClass();

        if(is_numeric($permissions)){
            return $permissionClass->findById($permissions);
        }
        
        if(is_string($permissions)){
            return $permissionClass->findByName($permissions);
        }

        if(is_array($permissions)){
            return $permissionClass->whereIn('name',$permissions)->get();
        }

        return $permissions;
    }


    
    public function givePermissionTo(...$permissions)
    {
        $permissions = collect($permissions)->flatten()->reduce(
            function($array,$permission){
                if(empty($permission)){
                    return $array;
                }

                $permission = $this->getStoredPermissions($permission);

                if(! $permission instanceof Permission){
                    return $array;
                }

                $array[$permission->getKey()] = [];

                return $array;
            },[]
        );

        $model =  $this->getModel();

        if($model->exists){
            $this->permissions()->sync($permissions, false);
            $model->load('permissions');
        }

        return $this;
    }



    public function syncPermissions(...$permissions)
    {
        $this->permissions()->detach();

        return $this->givePermissionTo($permissions);
    }



    public function revokePermissionTo($permission)
    {
        $this->permissions()->detach($this->getStoredPermissions($permission));

        $this->load('permissions');

        return $this;
    }



    
}
