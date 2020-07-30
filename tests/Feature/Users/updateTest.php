<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
include_once 'tests/TestHelpers.php';

class updateTest extends TestCase
{
    use RefreshDatabase;
    protected $request = [
            'name' => 'Nixon Jeiler',
            'email' => 'nixon@admin.com',
            'isAdmin' => true,
            'isEnabled' => true
        ];

    /**
     * Tests for update Users
     *
     * @test
     * @dataProvider ValidUserInputDataProvider
     * @param string $data
     */
    public function anAdminCanUpdateUsersWithValidUserInputs(string $data)
    {
        $this->withoutExceptionHandling();
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $user = factory(User::class)->create();
        $oldData = removeTimeKeys($user->toArray());
        $validRequest = $this->request;
        if ($data != 'new')
            if($data == 'same')
                $validRequest = $oldData;
            else
                $validRequest[$data] = $oldData[$data];

        // Act
        $this->actingAs($admin);
        $response = $this->put(route('users.update',$user),$validRequest);

        // Assert
        $response->assertOk();
        $response->assertViewIs('users.show',$user->id);
        $this->assertDatabaseHas('users',$validRequest);
        if ($data != 'new')
            if($data == 'same')
                $this->assertDatabaseHas('users',$oldData);
            else{
                $validRequest[$data] = $oldData[$data];
                $this->assertDatabaseHas('users', [
                    $data => $oldData[$data],
                ]);
            }
        else
        $this->assertDatabaseMissing('users',$oldData);
    }

    /**
     * Tests for update Users
     *
     * @test
     * @dataProvider InvalidUserInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotUpdateUsersWithInvalidUserInputs(string $field, ?string $value)
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $user = factory(User::class)->create();
        $oldData = removeTimeKeys($user->toArray());

        // Act
        $this->actingAs($admin);
        $invalidRequest = $this->request;
        $invalidRequest[$field] = $value;
        if($value == 'nixon@admin.com'){
            $invalidRequest[$field] = $admin->email;
        }
        $response = $this->put(route('users.update',$user),$invalidRequest);

        // Assert
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('users',$invalidRequest);
    }

    /**
     * Tests for update Users
     *
     * @test
     */
    public function anUserCannotUpdateUsers()
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->put(route('users.update',$user),$this->request);

        // Assert
        $response->assertRedirect();
    }

    /**
     * Tests for update Users
     *
     * @test
     */
    public function anGuestCannotUpdateUsers()
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $response = $this->put(route('users.update',$user),$this->request);

        // Assert
        $response->assertRedirect('login');
    }

    public function ValidUserInputDataProvider()
    {
        return [
            'New data' => ['new'],
            'Same data' => ['same'],
            'Same name' => ['name'],
            'same email' => ['email'],
            'Same isAdmin status' => ['isAdmin'],
            'Same isEnabled status' => ['isEnabled']
        ];
    }

    public function InvalidUserInputDataProvider()
    {
        return [
            'No name' => ['name', null],
            'A name too short' => ['name', Str::random(2)],
            'A name too large' => ['name', Str::random(41)],
            'No email' => ['name', null],
            'A email too large' => ['email', Str::random(60) . '@test.com'],
            'A repeated email' => ['email', 'nixon@admin.com'],
            'Email is not an email' => ['email', Str::random(29)]
        ];
    }
}
