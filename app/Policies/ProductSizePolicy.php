<?php

namespace App\Policies;

use App\Models\ProductSize;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductSizePolicy
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
        return $user->hasPermissionTo('view-size') === true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->HasPermissionTo('create-size') === true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductSize  $size
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProductSize $size)
    {
        return $user->hasPermissionTo('update-size') === true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductSize  $size
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProductSize $size)
    {
        return $user->hasPermissionTo('delete-size') === true;
    }

}
