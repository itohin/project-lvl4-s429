<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guestsCannotSeeUsersPage()
    {
        $this->get(route('users.index'))->assertRedirect('login');
    }

    /** @test */
    public function userCanSeeAllUsersPage()
    {
        $this->signIn();
        $this->get(route('users.index'))->assertStatus(200);
    }

    /** @test */
    public function userCanEditOwnProfile()
    {
        $user = $this->signIn();
        $this->get(route('users.edit', $user))->assertSee($user->name);

        $attributes = ['name' => 'New name', 'email' => 'new@gmail.com'];

        $this->patch(route('users.update', $user), $attributes);
        $this->assertDatabaseHas('users', $attributes);
    }

    /** @test */
    public function userCanDeleteOwnProfile()
    {
        $user = $this->signIn();

        $this->delete(route('users.destroy', $user));
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    /** @test */
    public function userCannotDeleteAnotherProfiles()
    {
        $this->signIn();
        $user = factory('App\User')->create();

        $this->delete(route('users.destroy', $user))->assertStatus(403);
    }

    /** @test */
    public function userCannotEditAnotherProfiles()
    {
        $this->signIn();
        $anotherUser = factory('App\User')->create();

        $this->get(route('users.edit', $anotherUser))->assertStatus(403);
    }

    /** @test */
    public function userHasTasks()
    {
        $user = factory('App\User')->create();
        $this->assertInstanceOf(Collection::class, $user->tasks);
    }
}
