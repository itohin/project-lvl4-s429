<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_see_users_page()
    {
        $this->get(route('users.index'))->assertRedirect('login');
    }

    /** @test */
    public function user_can_see_all_users_page()
    {
        $this->signIn();
        $this->get(route('users.index'))->assertStatus(200);
    }

    /** @test */
    public function user_can_edit_own_profile()
    {
        $user = $this->signIn();
        $this->get(route('users.edit', $user))->assertSee($user->name);

        $attributes = ['name' => 'New name', 'email' => 'new@gmail.com'];

        $this->patch(route('users.update', $user), $attributes);
        $this->assertDatabaseHas('users', $attributes);
    }

    /** @test */
    public function user_can_delete_own_profile()
    {
        $user = $this->signIn();

        $this->delete(route('users.delete', $user));
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    /** @test */
    public function user_cannot_delete_another_profiles()
    {
        $this->signIn();
        $user = factory('App\User')->create();

        $this->delete(route('users.delete', $user))->assertStatus(403);
    }

    /** @test */
    public function user_cannot_edit_another_profiles()
    {
        $this->signIn();
        $anotherUser = factory('App\User')->create();

        $this->get(route('users.edit', $anotherUser))->assertStatus(403);
    }
}
