<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
include_once 'tests/TestHelpers.php';

class editTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests for edit Users
     *
     * @test
     */
    public function anAdminCanEditUsers()
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($admin);
        $response = $this->get(route('users.edit',$user));

        // Assert
        $response->assertOk();
        $response->assertViewIs('users.edit');
        $response->assertViewHas('user');
        $responseUser = $response->getOriginalContent()['user']->toArray();
        $this->assertDatabaseHas('users',timeDiff($responseUser));
    }

    /**
     * Tests for edit Users
     *
     * @test
     */
    public function anUserCannotEditUsers()
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->get(route('users.edit',$user));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Tests for edit Users
     *
     * @test
     */
    public function anGuestCannotEditUsers()
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $response = $this->get(route('users.edit',$user));

        // Assert
        $response->assertRedirect('login');
    }
}
