<?php


namespace App\Actions;


use App\User;

class RefreshRolesAction
{

    /**
     * @param User $user
     * @param int $rol_id
     */
    public function execute(User $user, int $rol_id) : void
    {
        $user->syncRoles($rol_id);
    }

}
