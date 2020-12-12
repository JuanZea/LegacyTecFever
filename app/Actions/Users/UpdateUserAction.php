<?php


namespace App\Actions\Users;


use App\User;

class UpdateUserAction
{

    /**
     * @param array $request
     * @param User $user
     */
    public function execute(array $request, User $user) : void
    {
        $request = $this->refreshStatus($request);
        $user->update($request);
    }

    private function refreshStatus(array $request): array
    {
        if (!isset($request['is_enabled'])) {
            array_push($request, ['is_Enabled' => 0]);
        }
        return $request;
    }

}
