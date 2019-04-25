<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function auth_user_can_create_status()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get(route('status.create'))->assertStatus(200);

        $this->post(route('status.store'), $attributes = ['name' => 'New']);

        $this->assertDatabaseHas('statuses', $attributes);
    }

    /** @test */
    public function auth_user_can_update_status()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $status = factory('App\Status')->create();

        $this->get(route('status.edit', $status))->assertStatus(200);

        $this->patch(route('status.update', $status), $attributes = ['name' => 'Changed']);

        $this->assertDatabaseHas('statuses', $attributes);
    }
}
