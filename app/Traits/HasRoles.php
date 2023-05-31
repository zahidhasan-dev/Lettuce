<?php

namespace App\Traits;

use App\Contracts\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{

    use HasPermissions;

    private $roleClass = \App\Models\Role::class;



    public function getRoleClass()
    {
        return app($this->roleClass);    
    }



    public function roles(): BelongsToMany
    {
        return $this->belongsToMany($this->roleClass);
    }


    
    public function getAllRoles()
    {
        return $this->roles;
    }

    
    
    public function hasRole($roles)
    {
        if(is_string($roles)){
            return $this->roles->contains('name',$roles);
        }

        if(is_int($roles)){
            $roleClass = $this->getRoleClass();
            $key = (new $roleClass())->getKeyName();

            return $this->roles->contains($key,$roles);
        }

        if($roles instanceof Role){
            return $this->roles->contains($roles->getKeyName(),$roles->getKey());
        }

        if(is_array($roles)){
            foreach($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }

            return false;
        }

       return $roles->intersect($this->roles)->isNotEmpty();
    }



    public function assignRole(...$roles)
    {
        $roles = collect($roles)->flatten()->reduce(function($array,$role){
            if(empty($role)){
                return $array;
            }

            $role = $this->getStoredRole($role);

            if(! $role instanceof Role){
                return $array;
            }

            $array[$role->getKey()] = []; 

            return $array;

        }, []);

        $model = $this->getModel();

        if($model->exists){
            $this->roles()->sync($roles, false);
            $model->load('roles');
        }

        return $this;
    }




    public function removeRole($role)
    {
        $this->roles()->detach($this->getStoredRole($role));

        $this->load('roles');

        return $this;
    }



    public function syncRoles(...$roles)
    {
        $this->roles()->detach();

        return $this->assignRole($roles);
    }



    public function hasAnyRole(...$roles)
    {
        return $this->hasRole($roles);
    }



    public function hasAllRoles($roles)
    {
        if(is_string($roles)){
            return $this->roles->contains('name',$roles);
        }

        if($roles instanceof Role){
            return $this->roles->contains($roles->getKeyName(),$roles->getKey());
        }

        $roles = collect()->make($roles)->map(function($role){
            return $role instanceof Role ? $role->name : $role;
        });

        return $roles->intersect($this->getRoleNames()) == $roles;
    }



    public function hasExactRoles($roles)
    {
        if(is_string($roles)){
            $roles = [$roles];
        }

        if($roles instanceof Role){
            $roles = [$roles->name];
        }

        $roles = collect()->make($roles)->map(function($role){
            return $role instanceof Role ? $role->name : $role;
        });

        return $this->roles->count() == $roles->count() && $this->hasAllRoles($roles);
    }



    public function getDirectPermissions()
    {
        return $this->permissions;
    }



    public function getRoleNames()
    {
        return $this->roles->pluck('name');
    }



    protected function getStoredRole($role)
    {
        $roleClass = $this->getRoleClass();

        if(is_numeric($role)){
            return $roleClass->findById($role);
        }

        if(is_string($role)){
            return $roleClass->findByName($role);
        }

        return $role;
    }


}

