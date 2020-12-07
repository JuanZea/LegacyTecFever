<?php

namespace App\Policies;

use App\ShoppingCart;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingCartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingCart  $shoppingCart
     * @return mixed
     */
    public function view(User $user, ShoppingCart $shoppingCart)
    {
        return $user->id === $shoppingCart->user_id;
    }

    /**
     * Determine whether the user can edit the model.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingCart  $shoppingCart
     * @return mixed
     */
    public function edit(User $user, ShoppingCart $shoppingCart)
    {
        return $user->id === $shoppingCart->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingCart  $shoppingCart
     * @return mixed
     */
    public function update(User $user, ShoppingCart $shoppingCart)
    {
        return $user->id === $shoppingCart->user_id;
    }
}
