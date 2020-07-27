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

    /**
     * Tests for RouteController
     * @test
     * @dataProvider RoutesForUsersDataProvider
     * @param Array $allowed
     * @param Array $both
     * @param Array $forbidden
     */
    public function RouteIsAllowedOrForbiddenForGuestUser(Array $allowed, Array $both, Array $forbidden)
    {
        // Arrange
        $allowed = array_merge($allowed,$both);

        foreach ($allowed as $route) {
            // Act
            $response = $this->get($route);

            // Assert
            $response->assertStatus(200);
        }

        foreach ($forbidden as $route) {
            // Act
            $response = $this->get($route);

            // Assert
            $response->assertRedirect(route('login'));
        }
    }

    /**
     * Tests for RouteController
     * @test
     * @dataProvider RoutesForUsersDataProvider
     * @param Array $allowed
     * @param Array $both
     * @param Array $forbidden
     */
    public function RouteIsAllowedOrForbiddenForAuthenticatedUser(Array $forbidden, Array $both, Array $allowed)
    {
        $this->withoutExceptionHandling();
        // Arrange
        $user = factory(User::class)->create();
        $allowed = array_merge($allowed,$both);

        // Act
        $this->actingAs($user);
        foreach ($allowed as $route) {
            // Act
            $response = $this->get($route);

            // Assert
            $response->assertStatus(200);
        }

        foreach ($forbidden as $route) {
            // Act
            $response = $this->get($route);

            // Assert
            $response->assertRedirect(route('home'));
        }
    }

    public function RoutesForUsersDataProvider() : array
    {
        return [
            'routes' => ['allowedForGuest' => ['/'], 'allowedForBoth' => [], 'forbiddenForGuest' => ['/home']]
        ];
    }
}
