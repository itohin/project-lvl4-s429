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
    public function authUserCanCreateStatus()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get(route('status.create'))->assertStatus(200);

        $this->post(route('status.store'), $attributes = ['name' => 'New']);

        $this->assertDatabaseHas('statuses', $attributes);
    }

    /** @test */
    public function authUserCanUpdateStatus()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $status = factory('App\Status')->create();

        $this->get(route('status.edit', $status))->assertStatus(200);

        $this->patch(route('status.update', $status), $attributes = ['name' => 'Changed']);

        $this->assertDatabaseHas('statuses', $attributes);
    }

    /** @test */
    public function authUserCanDeleteStatus()
    {
        $this->signIn();

        $status = factory('App\Status')->create();

        $this->delete(route('status.destroy', $status));

        $this->assertDatabaseMissing('statuses', $status->toArray());
    }

    /** @test */
    public function statusHasManyTasks()
    {
        $status = factory('App\Status')->create();
        factory('App\Task')->create();

        $this->assertInstanceOf(Task::class, $status->tasks->first());
    }
}
