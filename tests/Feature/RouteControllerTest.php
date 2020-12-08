<?php

namespace Tests\Feature;

use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class RouteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        TestHelpers::activeRoles();
    }

    /**
     * Check if the route is allowed for guest
     * @test
     * @dataProvider validRouteForGuestDataProvider
     * @param string $route
     * @retrun void
     */
    public function RouteIsAllowedForGuest(string $route) : void
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
     * @retrun void
     */
    public function RouteIsForbiddenForGuest(string $route) : void
    {
        // Act
        $response = $this->get(route($route));

        // Assert
        $response->assertRedirect('login');
    }

    /**
     * Check if the route is allowed for enabled user
     * @test
     * @dataProvider validRouteForEnabledUserDataProvider
     * @param string $route
     * @retrun void
     */
    public function RouteIsAllowedForEnabledUser(string $route) : void
    {
        $this->withoutExceptionHandling();
        // Arrange
        $user = factory(User::class)->create(['is_enabled' => true]);
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);

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
     * @retrun void
     */
    public function RouteIsForbiddenForEnabledUser(string $route) : void
    {
         // Arrange
        $user = factory(User::class)->create(['is_enabled' => true]);

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
     * @retrun void
     */
    public function RouteIsAllowedForDisabledUser(string $route) : void
    {
         // Arrange
        $user = factory(User::class)->create(['is_enabled' => false]);
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);

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
     * @retrun void
     */
    public function RouteIsForbiddenForDisabledUser(string $route) : void
    {
         // Arrange
        $user = factory(User::class)->create(['is_enabled' => false]);
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);

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
     * @retrun void
     */
    public function RouteIsAllowedForAdmin(string $route) : void
    {
         // Arrange
        $admin = factory(User::class)->create(['is_enabled' => true])->assignRole('admin');
        factory(ShoppingCart::class)->create(['user_id' => $admin->id]);

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
     * @retrun void
     */
    public function RouteIsForbiddenForAdmin(string $route) : void
    {
         // Arrange
        $admin = factory(User::class)->create(['is_enabled' => true])->assignRole('admin');
        factory(ShoppingCart::class)->create(['user_id' => $admin->id]);

        // Act
        $this->actingAs($admin);
        $response = $this->get(route($route));

        // Assert
        $response->assertRedirect();
    }

    // PROVIDERS

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
