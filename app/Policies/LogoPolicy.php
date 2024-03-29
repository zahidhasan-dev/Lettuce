<?php

namespace App\Policies;

use App\Models\Logo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LogoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('view-logo') === true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Logo $logo)
    {
        return $user->hasPermissionTo('view-logo') === true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create-logo') === true;
    }



    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Logo $logo)
    {
        return $user->hasPermissionTo('delete-logo') === true;
    }


}
