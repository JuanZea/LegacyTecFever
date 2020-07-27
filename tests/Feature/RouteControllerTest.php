<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class RouteControllerTest extends TestCase
{
    use RefreshDatabase;
    // use WithoutMiddleware;

    /*Variables*/
    protected $routeNames = ['welcome','home','login','register','controlPanel'];

    /**
     * Tests for RouteController
     * @test
     * @dataProvider RoutesForGuestDataProvider
     * @param Array $routeNames
     * @param bool $isAllowed
     */
    public function RouteIsAllowedOrForbiddenForGuestUser(Array $routeNames, bool $isAllowed)
    {
        // Arrange

        if ($isAllowed) {
            foreach ($routeNames as $route) { // Allowed Routes
                // Act
                $response = $this->get(route($route));

                // Assert
                $response->assertStatus(200);
            }
        } else {
            foreach ($routeNames as $route) { // Forbidden Routes
                // Act
                $response = $this->get(route($route));

                // Assert
                $response->assertRedirect(route('login'));
            }
        }
    }

    /**
     * Tests for RouteController
     * @test
     * @dataProvider RoutesForAuthDataProvider
     * @param Array $routeNames
     * @param bool $isAllowed
     */
    public function RouteIsAllowedOrForbiddenForAuthenticatedUser(Array $routeNames, bool $isAllowed)
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($user);
        if ($isAllowed) {
            foreach ($routeNames as $route) { // Allowed Routes
                // Act
                $response = $this->get(route($route));

                // Assert
                $response->assertStatus(200);
            }
        } else {
            foreach ($routeNames as $route) { // Forbidden Routes
                // Act
                $response = $this->get(route($route));

                // Assert
                $response->assertRedirect();
                // dd($route);
            }
        }
    }

    /**
     * Tests for RouteController
     * @test
     */
    public function RouteIsAllowedOrForbiddenForAdminUser()
    {
        // Arrange
        $routeNames = ['controlPanel'];
        $user = factory(User::class)->create(['isAdmin' => true]);

        // Act
        $this->actingAs($user);
        foreach ($routeNames as $route) {
            // Act
            $response = $this->get(route($route));

            // Assert
            $response->assertStatus(200);
        }
    }

    public function RoutesForGuestDataProvider() : array
    {
        $allowed = ['welcome','login','register'];
        $forbidden = array_diff($this->routeNames, $allowed);
        return [
            'allowedRoutes' => [$allowed, true],
            'forbiddenRoutes' => [$forbidden, false],
        ];
    }

    public function RoutesForAuthDataProvider() : array
    {
        $allowed = ['home'];
        $forbidden = array_diff($this->routeNames, $allowed);
        return [
            'allowedRoutes' => [$allowed, true],
            'forbiddenRoutes' => [$forbidden, false],
        ];
    }
}
