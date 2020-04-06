<?php

namespace Tests\Unit\app\Repositories\User;

use App\Models\User;
use App\Repositories\User\EloquentUser;
use Kodeine\Acl\Models\Eloquent\Role;
use Tests\TestCase;

class EloquentUserTest extends TestCase
{
    protected $useDatabase = true;

    /** @var EloquentUser */
    private $sut;

    public function test_Should_GetUserById()
    {
        $user = factory(User::class)->create();

        $actual = $this->sut->byId($user->id);

        $this->assertTrue($user->is($actual));
    }

    public function test_Should_GetUsersByPage()
    {
        $users = factory(User::class, 5)->create();

        $actual = $this->sut->byPage();

        $this->assertCount(5, $actual->items());
    }

    public function test_Should_CreateNewUser()
    {
        $actual = $this->sut->create([
            'name'      => 'User 1',
            'email'     => 'user1@example.com',
            'password'  => '12345678',
            'api_token' => '12345678',
        ]);

        $this->assertDatabaseHas('users', $actual->toArray());
    }

    public function test_Should_UpdateExistingUser()
    {
        $user = factory(User::class)->create();

        $this->sut->update([
            'id'        => $user->id,
            'name'      => 'User 2',
            'email'     => 'user2@example.com',
            'password'  => '23456789',
            'api_token' => '23456789',
        ]);

        $this->assertDatabaseHas('users', [
            'id'        => $user->id,
            'name'      => 'User 2',
            'email'     => 'user2@example.com',
            'password'  => '23456789',
            'api_token' => '23456789',
        ]);
    }

    public function test_Should_UpdateExistingUser_When_RoleIsSpecified()
    {
        $role = factory(Role::class)->create();
        $user = factory(User::class)->create();
        $user->assignRole($role->slug);

        $this->sut->update([
            'id'        => $user->id,
            'name'      => 'User 2',
            'email'     => 'user2@example.com',
            'password'  => '23456789',
            'api_token' => '23456789',
        ]);

        $this->assertDatabaseHas('users', [
            'id'        => $user->id,
            'name'      => 'User 2',
            'email'     => 'user2@example.com',
            'password'  => '23456789',
            'api_token' => '23456789',
        ]);
        $this->assertDatabaseHas('role_user', ['role_id' => $role->id, 'user_id' => $user->id]);
    }

    public function test_Should_UpdateExistingUser_When_RoleIsEmpty()
    {
        $role = factory(Role::class)->create();
        $user = factory(User::class)->create();
        $user->assignRole($role->slug);

        $this->sut->update([
            'id'        => $user->id,
            'name'      => 'User 2',
            'email'     => 'user2@example.com',
            'password'  => '23456789',
            'api_token' => '23456789',
        ]);

        $this->assertDatabaseHas('users', [
            'id'        => $user->id,
            'name'      => 'User 2',
            'email'     => 'user2@example.com',
            'password'  => '23456789',
            'api_token' => '23456789',
        ]);
        $this->assertDatabaseHas('role_user', ['role_id' => $role->id, 'user_id' => $user->id]);
    }

    public function test_Should_DeleteExistingUser()
    {
        $user = factory(User::class)->create();

        $this->sut->delete($user->id);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /**
     * @before
     */
    public function setUpSet(): void
    {
        $this->sut = new EloquentUser(new User());
    }
}
