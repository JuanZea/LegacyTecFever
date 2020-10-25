<?php

namespace Tests;

use Illuminate\Support\Facades\Route;

class TestHelpers{

    public const ONLYDISABLEDUSER = ['disabled'];
    public const ONLYGUEST = ['welcome','login','register'];
    public const ONLYADMIN = ['controlPanel'];
    public const CRUD = ['index','create','store','show','edit','update','destroy'];
    public const DESPICABLES = [
        'account'
    ];
    public const VALIDREQUESTFORUSER = [
        'name' => 'Nixon Jeiler',
        'email' => 'nixon@admin.com',
        'isAdmin' => false,
        'isEnabled' => true
    ];
    public const VALIDREQUESTFORPRODUCT = [
        'name' => 'Acer Aspire 5 Slim Laptop',
        'isEnabled' => true,
        'description' => '15.6 inches Full HD IPS Display, AMD Ryzen 3 3200U, Vega 3 Graphics, 4GB DDR4, 128GB SSD, Backlit Keyboard, Windows 10 in S Mode, A515-43-R19L,Silver',
        'category' => 'computer',
        'image' => null,
        'price' => '2900000'
    ];

    /**
     * Return the routes that do not belong to the CRUD or are they despicable
     *
     * @return array
     */
    public static function freeRoutes() : array
    {
        $routes = self::getRouteNames();
        $routes = self::removeCRUDRoutes($routes);
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

    public static function isDespicable(?string $name) : bool
    {
        if(strpos($name, 'assword') || strpos($name, 'erification') || strpos($name, 'ogout') || strpos($name, 'enerated') || strpos($name, 'ayment') || strpos($name, 'hoppingCarts') || is_null($name)) {
            return true;
        }
        return false;
    }
}
