<?php

namespace App\Policies;

use App\Models\About;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutPolicy
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
        return $user->hasPermissionTo('view-about') === true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\About  $about
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, About $about)
    {
        return $user->hasPermissionTo('view-about') === true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create-about') === true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\About  $about
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, About $about)
    {
        return $user->hasPermissionTo('update-about') === true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\About  $about
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, About $about)
    {
        return $user->hasPermissionTo('delete-about') === true;
    }
    

    public function updateAboutStatus(User $user, About $about)
    {
        return $user->hasPermissionTo('update-about');
    }
}
