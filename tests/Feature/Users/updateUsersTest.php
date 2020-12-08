<?php

namespace Tests\Feature\Users;

use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\TestHelpers;

class updateUsersTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $user;
    private $valid_user_request;

    public function setUp(): void
    {
        parent::setUp();
        TestHelpers::activeRoles();
        $this->valid_user_request = factory(User::class)->raw();
        unset($this->valid_user_request['email_verified_at']);
        unset($this->valid_user_request['remember_token']);
        unset($this->valid_user_request['api_token']);
        unset($this->valid_user_request['password']);
        unset($this->valid_user_request['document']);
        $this->admin = factory(User::class)->create(['is_enabled' => true])->assignRole('admin');
        factory(ShoppingCart::class)->create(['user_id' => $this->admin->id]);
        $this->user = factory(User::class)->create(['is_enabled' => true])->assignRole('user');
        factory(ShoppingCart::class)->create(['user_id' => $this->user->id]);
    }

    /**
     * @dataProvider validUserInputDataProvider
     * @test
     * @param string $data
     * @return void
     */
    public function anAdminCanUpdateUsersWithValidUserInputs(string $data)
    {
        // Arrange
        $oldData = TestHelpers::removeTimeKeys($this->user->toArray());
        $validRequest = $this->valid_user_request;
        unset($oldData['roles']);

        if($data == 'same') {
            $validRequest = $oldData;
        }
        if ($data != 'new' && $data != 'same') {
            $validRequest[$data] = $oldData[$data];
        }

        // Act
        $this->actingAs($this->admin);
        $response = $this->put(route('users.update', $this->user), $validRequest);

        // Asserts
        $response->assertRedirect();
        $this->assertDatabaseHas('users', $validRequest);
        // Asserts - New Data
        if ($data == 'new') {
            $this->assertDatabaseMissing('users', $oldData);
        }
    }

    /**
     * @test
     * @dataProvider invalidUserInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotUpdateUserWithInvalidUserInputs(string $field, ?string $value)
    {
        // Arrange
        $invalidRequest = $this->valid_user_request;
        $invalidRequest[$field] = $value;

        // Act
        $this->actingAs($this->admin);
        $response = $this->put(route('users.update', $this->user), $invalidRequest);

        // Assert
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('users', $invalidRequest);
    }

    /**
     * @test
     */
    public function anUserCanUpdateTheirInformationWithValidInformation()
    {
        // Act
        $this->actingAs($this->user);
        $response = $this->put(route('users.update', $this->user), $this->valid_user_request);

        // Asserts
        $response->assertRedirect();
        $this->assertDatabaseHas('users', $this->valid_user_request);
    }

    /**
     * @test
     */
    public function anUserCannotUpdateOtherUsers()
    {
        // Arrange
        $user = factory(User::class)->create()->assignRole('user');
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);

        // Act
        $this->actingAs($this->user);
        $response = $this->put(route('users.update', $user), $this->valid_user_request);

        // Asserts
        $response->assertStatus(403);
        $this->assertDatabaseMissing('users', $this->valid_user_request);
    }

    /**
     * @test
     */
    public function anGuestCannotUpdateUsers()
    {
        // Act
        $response = $this->put(route('users.update', $this->user), $this->valid_user_request);

        // Asserts
        $response->assertRedirect('login');
        $this->assertDatabaseMissing('users', $this->valid_user_request);
    }

    //PROVIDERS

    public function validUserInputDataProvider(): array
    {
        return [
            'New data' => ['new'],
            'Same data' => ['same'],
            'Same name' => ['name'],
            'same email' => ['email'],
            'Same is_enabled status' => ['is_enabled']
        ];
    }

    public function invalidUserInputDataProvider(): array
    {
        return [
            'No name' => ['name', null],
            'A name too short' => ['name', Str::random(1)],
            'A name too large' => ['name', Str::random(41)],
            'No email' => ['name', null],
            'A email too large' => ['email', Str::random(60) . '@test.com'],
            'Email is not an email' => ['email', Str::random(29)]
        ];
    }
}
