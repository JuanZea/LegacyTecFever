<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\TestHelpers;

class updateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests for update Users
     *
     * @test
     * @dataProvider validUserInputDataProvider
     * @param string $data
     */
    public function anAdminCanUpdateUsersWithValidUserInputs(string $data)
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true,'isEnabled' => true]);
        $user = factory(User::class)->create();
        $oldData = TestHelpers::removeTimeKeys($user->toArray());
        $validRequest = TestHelpers::VALIDREQUESTFORUSER;
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
        $response->assertViewIs('users.show');
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
     * @dataProvider invalidUserInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotUpdateUsersWithInvalidUserInputs(string $field, ?string $value)
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($admin);
        $invalidRequest = TestHelpers::VALIDREQUESTFORUSER;
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

    public function validUserInputDataProvider()
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

    public function invalidUserInputDataProvider()
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
