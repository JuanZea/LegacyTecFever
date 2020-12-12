<?php

namespace Tests;

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestHelpers{

    public const ONLYDISABLEDUSER = ['disabled'];
    public const ONLYGUEST = ['welcome', 'login', 'register'];
    public const ONLYADMIN = ['control_panel', 'reports.summary'];
    public const CRUD = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
    public const DESPICABLES = [
        'account', 'export', 'send_mail'
    ];
    public const VALIDREQUESTFORUSER = [
        'name' => 'Nixon Jeiler',
        'email' => 'nixon@admin.com',
        'is_admin' => false,
        'is_enabled' => true
    ];

    public static function activeRoles()
    {
        // Permission list

        // Users
        Permission::create(['name' => 'viewAny_users']);
        Permission::create(['name' => 'edit_users']);
        Permission::create(['name' => 'update_users']);
        Permission::create(['name' => 'view_users']);
        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'store_users']);
        Permission::create(['name' => 'destroy_users']);

        // Products
        Permission::create(['name' => 'viewAny_products']);
        Permission::create(['name' => 'edit_products']);
        Permission::create(['name' => 'update_products']);
        Permission::create(['name' => 'view_products']);
        Permission::create(['name' => 'create_products']);
        Permission::create(['name' => 'store_products']);
        Permission::create(['name' => 'destroy_products']);

        // Admin - Role
        Role::create(['name' => 'admin'])
            ->givePermissionTo([
            // Users
            'viewAny_users',
            'edit_users',
            'update_users',
            'view_users',
            'create_users',
            'store_users',
            'destroy_users',

            // Products
            'viewAny_products',
            'edit_products',
            'update_products',
            'view_products',
            'create_products',
            'store_products',
            'destroy_products'
        ]);

        // User - Role
        Role::create(['name' => 'user'])
            ->givePermissionTo([
            'view_products'
        ]);
    }

    /**
     * Return the routes that do not belong to the CRUD or are they despicable
     *
     * @return array
     */
    public static function freeRoutes() : array
    {
        $routes = self::getRouteNames();
        $routes = self::removeCRUDRoutes($routes);
        $routes = self::removeReportsRoutes($routes);
        $routes = self::removeDespicableRoutes($routes);
        return $routes;
    }

    /**
     * Return all route names
     *
     * @return array
     */
    public static function getRouteNames() : array
    {
        $routes = Route::getRoutes();
        $routeNames = [];
        foreach ($routes as $route) {
            array_push($routeNames, $route->getName());
        }
        return $routeNames;
    }

    /**
     * Returns routes that do not belong to CRUD
     *
     * @param array $routes
     * @return array
     */
    public static function removeCRUDRoutes(array $routes) :array
    {
        $cleanRoutes = [];
        foreach ($routes as $route) {
            if(!self::belongCRUD($route))
                array_push($cleanRoutes, $route);
        }

        return $cleanRoutes;
    }

    /**
     * Remove routes that do not belong to reports
     *
     * @param array $routes
     * @return array
     */
    public static function removeReportsRoutes(array $routes)
    {
        $cleanRoutes = [];
        foreach ($routes as $route) {
            if(!self::belongReports($route))
                array_push($cleanRoutes, $route);
        }

        return $cleanRoutes;
    }

    /**
     * Remove despicable routes except login and register
     *
     * @param array $routes
     * @return array
     */
    public static function removeDespicableRoutes(array $routes) :array
    {
        $cleanRoutes = [];
        foreach ($routes as $route) {
            if(!self::isDespicable($route))
                array_push($cleanRoutes, $route);
        }

        $cleanRoutes = array_diff($cleanRoutes, self::DESPICABLES);

        return $cleanRoutes;
    }

    /**
     * Remove fields with time values
     *
     * @param array $data
     * @return array
     */
    public static function removeTimeKeys(array $data) : array
    {
        unset($data['email_verified_at']);
        unset($data['created_at']);
        unset($data['updated_at']);
        return $data;
    }

    /**
     * Return if a route belongs to CRUD
     *
     * @param string|null $name
     * @return bool
     */
    public static function belongCRUD(?string $name) : bool
    {
        if(strpos($name, 'index') || strpos($name, 'create') || strpos($name, 'store') || strpos($name, 'show') || strpos($name, 'edit') || strpos($name, 'update') || strpos($name, 'destroy') || is_null($name)) {
            return true;
        }
        return false;
    }

    public static function belongReports($name)
    {
        if(strpos($name, 'mport') || strpos($name, 'xport') || strpos($name, 'download') || strpos($name, 'eport')) {
            return true;
        }
        return false;
    }

    public static function isDespicable(?string $name) : bool
    {
        if(strpos($name, 'assword') || strpos($name, 'erification') || strpos($name, 'ogout') || strpos($name, 'enerated') || strpos($name, 'ayment') || strpos($name, 'hoppingCarts') || is_null($name)) {
            return true;
        }
        return false;
    }


}
