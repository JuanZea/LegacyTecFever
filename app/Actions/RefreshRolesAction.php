<?php


namespace App\Actions;


use App\User;

class RefreshRolesAction
{

    public function __construct()
    {

    }

    /**
     * @param User $user
     * @param int $rol_id
     */
    public function execute(User $user, int $rol_id)
    {
        $user->syncRoles($rol_id);
    }

}
