<?php


namespace App\Actions;


use App\Product;
use App\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;

class RefreshRolesAction
{

    public function __construct()
    {

    }

    /**
     * @param array $request
     * @param Product $product
     */
    public function execute(User $user, int $rol_id)
    {
        $user->syncRoles($rol_id);
    }

}
