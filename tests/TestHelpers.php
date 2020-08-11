<?php

namespace Tests;

use Illuminate\Support\Facades\Route;

class TestHelpers{

    public const ONLYGUEST = ['welcome','login','register'];
    public const ONLYADMIN = ['controlPanel'];
    public const CRUD = ['index','create','store','show','edit','update','destroy'];
    public const VALIDREQUESTFORUSER = [
                                    'name' => 'Nixon Jeiler',
                                    'email' => 'nixon@admin.com',
                                    'isAdmin' => true,
                                    'isEnabled' => true
                                ];
    public const VALIDREQUESTFORPRODUCT = [
                                        'name' => 'Acer Aspire 5 Slim Laptop',
                                        'description' => '15.6 inches Full HD IPS Display, AMD Ryzen 3 3200U, Vega 3 Graphics, 4GB DDR4, 128GB SSD, Backlit Keyboard, Windows 10 in S Mode, A515-43-R19L,Silver',
                                        'category' => 'computer',
                                        'image' => './public/storage/images/ASUSVivoBook.jpg',
                                        'price' => '2900000'
                                    ];

    /**
     * Return the routes that do not belong to the CRUD or to the default of laravel/ui
     *
     * @return array
     */
    public static function freeRoutes() : array
    {
        $routes = array_diff(self::routesWithoutCRUD(), self::ONLYGUEST);
        $routes = self::removeLUIRoutes($routes);
        return $routes;
    }

    /**
     * Generates the 7 routes of a crud and returns them in array
     *
     * @param $name
     */
    public static function generateCrud($name) : array
    {
        $routeNames = array();
        foreach (CRUD as $crudItem) {
            $routeNames = array_merge($routeNames,[$name.'.'.$crudItem]);
        }

        return routeNames;
    }

    /**
     * Returns routes that do not belong to CRUD
     *
     * @return array
     */
    public static function routesWithoutCRUD() :array
    {
        $routeNames = array();
        foreach (Route::getRoutes() as $route) {
            if(!self::filterCRUD($route->getName()))
                $routeNames = array_merge($routeNames,[$route->getName()]);
        }

        return $routeNames;
    }

    /**
     * Remove laravel/ui default routes except login and register
     *
     * @return array
     */
    public static function removeLUIRoutes($routes) :array
    {
        $routeNames = array();
        foreach ($routes as $route) {
            if(!self::filterLUI($route))
                $routeNames = array_merge($routeNames,[$route]);
        }

        return $routeNames;
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
     * Clone a array
     *
     * @param array $original the array to be cloned
     * @return array $clone the original array clone
     */
    public static function cloneArray(array $original) : array
    {
        $clone = [];
        $clone = array_merge($clone, $original);
        return $clone;
    }

    /**
     * Filter the values that contain store, update, destroy or that are null returning false
     *
     * @param string $name the value to evaluate
     * @return bool
     */
    public static function filterSUD(?string $name) : bool
    {
        if(strpos($name, 'store') || strpos($name, 'update') || strpos($name, 'destroy') || is_null($name))
            return true;
        return false;
    }

    public static function filterCRUD(?string $name) : bool
    {
        if(strpos($name, 'index') || strpos($name, 'create') || strpos($name, 'store') || strpos($name, 'show') || strpos($name, 'edit') || strpos($name, 'update') || strpos($name, 'destroy') || is_null($name))
            return true;
        return false;
    }

    public static function filterLUI(?string $name) : bool
    {
        if(strpos($name, 'assword') || strpos($name, 'erification') || strpos($name, 'ogout') || strpos($name, 'enerated') || is_null($name))
            return true;
        return false;
    }

    /**
     * Save custom aliases
     *
     * @param string $alias the alias to use
     * @return string the expanded expression
     */
    public static function alias(string $alias) : string
    {
        switch ($alias) {
            case 'p':
                return 'products';
                break;
            case 'u':
                return 'users';
                break;
            default:
                # code...
                break;
        }
    }
}

// ----------------------------------------------
