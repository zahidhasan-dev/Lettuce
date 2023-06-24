<?php

namespace App\Policies;

use App\Models\ContactEmail;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactEmailPolicy
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
        return $user->hasPermissionTo('view-contact') === true;
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create-contact') === true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactEmail  $contactEmail
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContactEmail $contactEmail)
    {
        return $user->hasPermissionTo('update-contact') === true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactEmail  $contactEmail
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContactEmail $contactEmail)
    {
        return $user->hasPermissionTo('delete-contact') === true;
    }


}
