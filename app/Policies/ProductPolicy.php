<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * @param $user
     * @return bool|null
     */
    public function before($user): ?bool
    {
        if($user->hasRole('admin')) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('viewAny_products');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissionTo('view_products');
    }

    /**
     * Determine whether the user can see create form.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create_products');
    }

    /**
     * Determine whether the user can store models.
     *
     * @param User $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasPermissionTo('store_products');
    }

    /**
     * Determine whether the user can see edit form.
     *
     * @param User $user
     * @return mixed
     */
    public function edit(User $user)
    {
        return $user->hasPermissionTo('edit_products');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasPermissionTo('update_products');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissionTo('destroy_products');
    }
}
