<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class showTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Tests for show of Users
     *
     * @test
     */
    public function anAdminCanShowUsers()
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $user = factory(User::class)->create();
        function timeDiff(array $userData) : array
        {
            unset($userData['email_verified_at']);
            unset($userData['created_at']);
            unset($userData['updated_at']);
            return $userData;
        }

        // Act
        $this->actingAs($admin);
        $response = $this->get(route('users.show',$user));

        // Assert
        $response->assertOk();
        $response->assertViewIs('users.show');
        $response->assertViewHas('user');
        $responseUser = $response->getOriginalContent()['user']->toArray();
        $this->assertDatabaseHas('users',timeDiff($responseUser));
    }

    /**
     * Tests for show of Users
     *
     * @test
     */
    public function anUserCannotShowUsers()
    {
        // Arrange
        $user = factory(User::class)->create(['isAdmin' => false]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route('users.show',$user));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Tests for show of Users
     *
     * @test
     */
    public function anGuestCannotShowUsers()
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $response = $this->get(route('users.show',$user));

        // Assert
        $response->assertRedirect('login');
    }
}
