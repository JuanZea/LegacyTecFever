<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
include_once 'tests/TestHelpers.php';

class RouteControllerTest extends TestCase
{
    use RefreshDatabase;

    // use WithoutMiddleware;

    /**
     * Check if the route is allowed for guest
     * @test
     * @dataProvider validRouteForGuestDataProvider
     * @param string $route
     */
    public function RouteIsAllowedForGuest($route)
    {
        // Act
        $response = $this->get(route($route));

        // Assert
        $response->assertOk();
        if($route == 'login' || $route == 'register')
            $response->assertViewIs('auth.'.$route);
        else
            $response->assertViewIs($route);
    }

    /**
     * Check if the route is forbidden for guest
     * @test
     * @dataProvider invalidRouteForGuestDataProvider
     * @param string $route
     */
    public function RouteIsForbiddenForGuest($route)
    {
        // Act
        $response = $this->get(route($route));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Check if the route is allowed for user
     * @test
     * @dataProvider validRouteForUserDataProvider
     * @param string $route
     */
    public function RouteIsAllowedForUser($route)
    {
         // Arrange
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->get(route($route));

        // Assert
        $response->assertOk();
        $response->assertViewIs($route);
    }

    /**
     * Check if the route is forbidden for user
     * @test
     * @dataProvider invalidRouteForUserDataProvider
     * @param string $route
     */
    public function RouteIsForbiddenForUser($route)
    {
         // Arrange
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->get(route($route));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Check if the route is allowed for admin
     * @test
     * @dataProvider validRouteForAdminDataProvider
     * @param string $route
     */
    public function RouteIsAllowedForAdmin($route)
    {
         // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);

        // Act
        $this->actingAs($admin);
        $response = $this->get(route($route));

        // Assert
        $response->assertOk();
        $response->assertViewIs($route);
    }

    /**
     * Check if the route is forbidden for admin
     * @test
     * @dataProvider invalidRouteForAdminDataProvider
     * @param string $route
     */
    public function RouteIsForbiddenForAdmin($route)
    {
         // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);

        // Act
        $this->actingAs($admin);
        $response = $this->get(route($route));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Check that a guset cannot search for products
     * @test
     */
    public function AGuestCannotSearchAProduct()
    {
        // Arrange
        $product = factory(Product::class)->create();

        // Act
        $response = $this->get(route('products.shop',['name' => $product->name]));

        // Assert
        $response->assertRedirect('login');
    }

    /**
     * Check that a user can search for products
     * @test
     */
    public function AUserCanSearchAProduct()
    {
        // Arrange
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->get(route('products.shop',['name' => $product->name]));

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.shop');
    }

    /**
     * Check that a admin can search for products
     * @test
     */
    public function AAdminCanSearchAProduct()
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($admin);
        $response = $this->get(route('products.shop',['name' => $product->name]));

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.shop');
    }

    public function validRouteForGuestDataProvider() : array
    {
        parent::setUp(); // :D
        $routes = ONLYGUEST;
        $return = array();
        foreach ($routes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    public function invalidRouteForGuestDataProvider() : array
    {
        parent::setUp(); // :D
        $validRoutes = ONLYGUEST;
        $invalidRoutes = array_diff(freeRoutes(), $validRoutes);
        $return = array();
        foreach ($invalidRoutes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    public function validRouteForUserDataProvider() : array
    {
        parent::setUp(); // :D
        $routes = array_diff(freeRoutes(),ONLYADMIN);
        $return = array();
        foreach ($routes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    public function invalidRouteForUserDataProvider() : array
    {
        parent::setUp(); // :D
        $validRoutes = array_diff(freeRoutes(),ONLYADMIN);
        $invalidRoutes = array_merge(array_diff(freeRoutes(), $validRoutes),ONLYGUEST);
        $return = array();
        foreach ($invalidRoutes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    public function validRouteForAdminDataProvider() : array
    {
        parent::setUp(); // :D
        $routes = freeRoutes();
        $return = array();
        foreach ($routes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    public function invalidRouteForAdminDataProvider() : array
    {
        parent::setUp(); // :D
        $validRoutes = freeRoutes();
        $invalidRoutes = array_merge(array_diff(freeRoutes(), $validRoutes),ONLYGUEST);
        $return = array();
        foreach ($invalidRoutes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }
}