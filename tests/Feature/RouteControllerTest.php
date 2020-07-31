<?php

namespace Tests\Feature;

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
        $invalidRoutes = array_diff(freeRoutes(), $validRoutes);
        $return = array();
        foreach ($invalidRoutes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }
}