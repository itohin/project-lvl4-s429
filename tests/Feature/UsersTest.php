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
    }

    /** @test */
    public function user_cannot_edit_another_profiles()
    {
        $this->signIn();
        $anotherUser = factory('App\User')->create();

        $this->get(route('users.edit', $anotherUser))->assertStatus(403);
    }
}
