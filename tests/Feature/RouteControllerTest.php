<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class RouteControllerTest extends TestCase
{
    use RefreshDatabase;

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
     * Check if the route is allowed for enabled user
     * @test
     * @dataProvider validRouteForEnabledUserDataProvider
     * @param string $route
     */
    public function RouteIsAllowedForEnabledUser($route)
    {
         // Arrange
        $user = factory(User::class)->create(['isEnabled' => true]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route($route));

        // Assert
        $response->assertOk();
        $response->assertViewIs($route);
    }

    /**
     * Check if the route is forbidden for enabled user
     * @test
     * @dataProvider invalidRouteForEnabledUserDataProvider
     * @param string $route
     */
    public function RouteIsForbiddenForEnabledUser($route)
    {
         // Arrange
        $user = factory(User::class)->create(['isEnabled' => true]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route($route));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Check if the route is allowed for disabled user
     * @test
     * @dataProvider validRouteForDisabledUserDataProvider
     * @param string $route
     */
    public function RouteIsAllowedForDisabledUser($route)
    {
         // Arrange
        $user = factory(User::class)->create(['isEnabled' => false]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route($route));

        // Assert
        $response->assertOk();
        $response->assertViewIs($route);
    }

    /**
     * Check if the route is forbidden for disabled user
     * @test
     * @dataProvider invalidRouteForDisabledUserDataProvider
     * @param string $route
     */
    public function RouteIsForbiddenForDisabledUser($route)
    {
         // Arrange
        $user = factory(User::class)->create(['isEnabled' => false]);

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
        $admin = factory(User::class)->create(['isAdmin' => true,'isEnabled' => true]);

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
        $admin = factory(User::class)->create(['isAdmin' => true,'isEnabled' => true]);

        // Act
        $this->actingAs($admin);
        $response = $this->get(route($route));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Group of routes allowed for a guest
     * @return array
     */
    public function validRouteForGuestDataProvider() : array
    {
        parent::setUp(); // :D
        $routes = TestHelpers::ONLYGUEST;
        $return = array();
        foreach ($routes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    /**
     * Group of routes forbidden for a guest
     * @return array
     */
    public function invalidRouteForGuestDataProvider() : array
    {
        parent::setUp(); // :D
        $invalidRoutes = array_diff(TestHelpers::freeRoutes(), TestHelpers::ONLYGUEST);
        $return = array();
        foreach ($invalidRoutes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    /**
     * Group of routes allowed for a enabled user
     * @return array
     */
    public function validRouteForEnabledUserDataProvider() : array
    {
        parent::setUp(); // :D
        $routes = array_diff(TestHelpers::freeRoutes(),TestHelpers::ONLYGUEST,TestHelpers::ONLYADMIN,TestHelpers::ONLYDISABLEDUSER);
        $return = array();
        foreach ($routes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    /**
     * Group of routes forbidden for a enabled user
     * @return array
     */
    public function invalidRouteForEnabledUserDataProvider() : array
    {
        parent::setUp(); // :D
        $invalidRoutes = array_merge(TestHelpers::ONLYGUEST,TestHelpers::ONLYADMIN,TestHelpers::ONLYDISABLEDUSER);
        $return = array();
        foreach ($invalidRoutes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    /**
     * Group of routes allowed for a disabled user
     * @return array
     */
    public function validRouteForDisabledUserDataProvider() : array
    {
        parent::setUp(); // :D
        $routes = TestHelpers::ONLYDISABLEDUSER;
        $return = array();
        foreach ($routes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    /**
     * Group of routes forbidden for a disabled user
     * @return array
     */
    public function invalidRouteForDisabledUserDataProvider() : array
    {
        parent::setUp(); // :D
        $invalidRoutes = array_diff(TestHelpers::freeRoutes(),TestHelpers::ONLYDISABLEDUSER);
        $return = array();
        foreach ($invalidRoutes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    /**
     * Group of routes allowed for a admin
     * @return array
     */
    public function validRouteForAdminDataProvider() : array
    {
        parent::setUp(); // :D
        $routes = array_diff(TestHelpers::freeRoutes(),TestHelpers::ONLYGUEST,TestHelpers::ONLYDISABLEDUSER);
        $return = array();
        foreach ($routes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }

    /**
     * Group of routes forbidden for a admin
     * @return array
     */
    public function invalidRouteForAdminDataProvider() : array
    {
        parent::setUp(); // :D
        $invalidRoutes = array_merge(TestHelpers::ONLYGUEST,TestHelpers::ONLYDISABLEDUSER);
        $return = array();
        foreach ($invalidRoutes as $route) {
            $return = array_merge($return,[$route => [$route]]);
        }
        return $return;
    }
}
