<?php

namespace App\Policies;

use App\Models\ContactAddress;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactAddressPolicy
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
     * @param  \App\Models\ContactAddress  $contactAddress
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContactAddress $contactAddress)
    {
        return $user->hasPermissionTo('update-contact') === true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactAddress  $contactAddress
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContactAddress $contactAddress)
    {
        return $user->hasPermissionTo('delete-contact') === true;
    }


}
