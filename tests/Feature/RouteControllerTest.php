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
    protected array $routeNames = ['welcome','home','login','register','controlPanel'];

    /**
     * Tests for RouteController
     * @test
     * @dataProvider RoutesForGuestDataProvider
     * @param Array $routeNames
     * @param bool $isAllowed
     */
    public function RouteIsAllowedOrForbiddenForGuest(Array $routeNames, bool $isAllowed)
    {
        if ($isAllowed) {
            foreach ($routeNames as $route) { // Allowed Routes
                // Act
                $response = $this->get(route($route));

                // Assert
                $response->assertOk();
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
     * @dataProvider RoutesForUserDataProvider
     * @param Array $routeNames
     * @param bool $isAllowed
     */
    public function RouteIsAllowedOrForbiddenForUser(Array $routeNames, bool $isAllowed)
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
                $response->assertOk();
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
    public function RouteIsAllowedOnlyForAdminUser()
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
            $response->assertOk();
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

    public function RoutesForUserDataProvider() : array
    {
        $allowed = ['home'];
        $forbidden = array_diff($this->routeNames, $allowed);
        return [
            'allowedRoutes' => [$allowed, true],
            'forbiddenRoutes' => [$forbidden, false],
        ];
    }
}