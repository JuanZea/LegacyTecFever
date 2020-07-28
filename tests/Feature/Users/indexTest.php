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
    public function anAdminUserCanListUsers()
    {
        $user = factory(User::class)->create(['isAdmin' => true]);
        $this->actingAs($user);
        // Act
        $response = $this->get(route('users.index'));

        // Assert
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
        $user = factory(User::class)->create(['isAdmin' => false]);
        $this->actingAs($user);
        // Act
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
