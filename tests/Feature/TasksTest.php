<?php

namespace Tests\Feature;

use App\Status;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_tasks()
    {
        $task = factory('App\Task')->create();

        $this->get(route('tasks.show', $task))->assertRedirect('login');
        $this->get(route('tasks.create'))->assertRedirect('login');
    }

    /** @test */
    public function all_tasks_available_on_tasks_page()
    {
        $this->get(route('tasks.index'))
            ->assertStatus(200)
            ->assertSee('No tasks yet.');

        $task = factory('App\Task')->create();
        factory('App\Status')->create();

        $this->get(route('tasks.index'))
            ->assertStatus(200)
            ->assertSee($task->name);
    }

    /** @test */
    public function task_belongs_to_creator()
    {
        $task = factory('App\Task')->create();

        $this->assertInstanceOf(User::class, $task->creator);
    }

    /** @test */
    public function task_belongs_to_asigned_user()
    {
        $task = factory('App\Task')->create();

        $this->assertInstanceOf(User::class, $task->assignedTo);
    }

    /** @test */
    public function task_belongs_to_status()
    {
        factory('App\Status')->create();
        $task = factory('App\Task')->create();

        $this->assertInstanceOf(Status::class, $task->status);
    }

    /** @test */
    public function single_task_available_on_task_page()
    {
        $this->signIn();

        $task = factory('App\Task')->create();
        factory('App\Status')->create();

        $this->get(route('tasks.show', $task))
            ->assertStatus(200)
            ->assertSee($task->name);
    }

    /** @test */
    public function auth_users_can_create_tasks()
    {
        $this->signIn();

        $this->get(route('tasks.create'))->assertStatus(200);

        $assigned = factory('App\User')->create();

        $this->post(route('tasks.store'), $attributes = ['name' => 'Test task', 'assigned_id' => $assigned->id]);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    /** @test */
    public function auth_users_can_update_own_tasks()
    {
        $user = $this->signIn();

        $task = factory('App\Task')->create(['creator_id' => auth()->id()]);

        $this->get(route('tasks.edit', $task))->assertStatus(200);

        $this->patch(route('tasks.update', $task), $attributes = ['name' => 'Updated task', 'description' => 'Changed', 'assigned_id' => $task->assigned_id]);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    /** @test */
    public function auth_users_cannot_update_other_tasks()
    {
        $this->signIn();

        $task = factory('App\Task')->create();

        $this->get(route('tasks.edit', $task))->assertStatus(403);
    }

    /** @test */
    public function tasks_can_sync_with_tags()
    {
        $task = factory('App\Task')->create();

        $tags = factory('App\Tag', 2)->create();

        $task->tags()->sync($tags->pluck('id')->toArray());

        $this->assertEquals(2, $task->tags->count());
    }
}
