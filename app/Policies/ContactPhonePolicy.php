<?php

namespace App\Policies;

use App\Models\ContactPhone;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPhonePolicy
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
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactPhone  $contactPhone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContactPhone $contactPhone)
    {
        //
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
     * @param  \App\Models\ContactPhone  $contactPhone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContactPhone $contactPhone)
    {
        return $user->hasPermissionTo('update-contact') === true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactPhone  $contactPhone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContactPhone $contactPhone)
    {
        return $user->hasPermissionTo('delete-contact') === true;
    }

    
}
