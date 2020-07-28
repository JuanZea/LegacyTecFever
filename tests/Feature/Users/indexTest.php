<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Tests for index of Users
     *
     * @test
     */
    public function anAdminCanListUsers()
    {
        // Arrange
        $user = factory(User::class)->create(['isAdmin' => true]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route('users.index'));

        // Assert
        $response->assertOk();
        $response->assertViewIs('users.index');
        $response->assertViewHas('users');
        $responseUsers = $response->getOriginalContent()['users'];
        $this->assertTrue($responseUsers->contains($user));
    }

    /**
     * Tests for index of Users
     *
     * @test
     */
    public function anUserCannotListUsers()
    {
        // Arrange
        $user = factory(User::class)->create(['isAdmin' => false]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route('users.index'));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Tests for index of Users
     *
     * @test
     */
    public function anGuestCannotListUsers()
    {
        // Act
        $response = $this->get(route('users.index'));

        // Assert
        $response->assertRedirect('login');
    }
}
