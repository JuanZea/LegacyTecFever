<?php

use Illuminate\Support\Facades\Route;

/**
 * Tests helpers
 */

// Constants ------------------------------------
const ONLYGUEST = ['welcome','login','register'];
const ONLYADMIN = ['controlPanel'];
const CRUD = ['index','create','store','show','edit','update','destroy'];
const VALIDREQUESTFORUSER = [
					            'name' => 'Nixon Jeiler',
					            'email' => 'nixon@admin.com',
					            'isAdmin' => true,
					            'isEnabled' => true
					        ];
const VALIDREQUESTFORPRODUCT = [
							        'name' => 'Acer Aspire 5 Slim Laptop',
							        'description' => '15.6 inches Full HD IPS Display, AMD Ryzen 3 3200U, Vega 3 Graphics, 4GB DDR4, 128GB SSD, Backlit Keyboard, Windows 10 in S Mode, A515-43-R19L,Silver',
							        'category' => 'computer',
							        'image' => './public/storage/images/ASUSVivoBook.jpg',
							        'price' => '2900000'
							    ];
// ----------------------------------------------
// Functions ------------------------------------

/**
* Return the routes that do not belong to the CRUD or to the default of laravel/ui
*
* @return array
*/
function freeRoutes() : array
{
    $routes = array_diff(routesWithoutCRUD(), ONLYGUEST);
    $routes = removeLUIRoutes($routes);
    return $routes;
}

/**
* Generates the 7 routes of a crud and returns them in array
*
* @param $name
*/
function generateCrud($name) : array
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
function routesWithoutCRUD() :array
{
    $routeNames = array();
    foreach (Route::getRoutes() as $route) {
        if(!filterCRUD($route->getName()))
            $routeNames = array_merge($routeNames,[$route->getName()]);
    }

    return $routeNames;
}

/**
* Remove laravel/ui default routes except login and register
*
* @return array
*/
function removeLUIRoutes($routes) :array
{
    $routeNames = array();
    foreach ($routes as $route) {
        if(!filterLUI($route))
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
function removeTimeKeys(array $data) : array
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
function cloneArray(array $original) : array
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
function filterSUD(?string $name) : bool
{
	if(strpos($name, 'store') || strpos($name, 'update') || strpos($name, 'destroy') || is_null($name))
	    return true;
	return false;
}

function filterCRUD(?string $name) : bool
{
	if(strpos($name, 'index') || strpos($name, 'create') || strpos($name, 'store') || strpos($name, 'show') || strpos($name, 'edit') || strpos($name, 'update') || strpos($name, 'destroy') || is_null($name))
	    return true;
	return false;
}

function filterLUI(?string $name) : bool
{
	if(strpos($name, 'assword') || strpos($name, 'erification') || strpos($name, 'ogout') || is_null($name))
	    return true;
	return false;
}

/**
* Save custom aliases
*
* @param string $alias the alias to use
* @return string the expanded expression
*/
function alias(string $alias) : string
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

/**
* Filter the values that contain store, update, destroy or that are null
*
* @param string $name the value to evaluate
*/
function filterGuest(?string $name) : bool
{

if(in_array($name, $guestAllowed)){
	return false;
}
	return true;
}

// ----------------------------------------------