<?php

namespace Tests\Feature;

use App\Task;
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

    /** @test */
    public function auth_user_can_delete_status()
    {
        $this->signIn();

        $status = factory('App\Status')->create();

        $this->delete(route('status.delete', $status));

        $this->assertDatabaseMissing('statuses', $status->toArray());
    }

    /** @test */
    public function status_has_many_tasks()
    {
        $status = factory('App\Status')->create();
        factory('App\Task')->create();

        $this->assertInstanceOf(Task::class, $status->tasks->first());
    }
}
