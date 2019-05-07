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
    public function guestsCannotManageTasks()
    {
        $task = factory('App\Task')->create();

        $this->get(route('tasks.show', $task))->assertRedirect('login');
        $this->get(route('tasks.create'))->assertRedirect('login');
        $this->delete(route('tasks.destroy', $task))->assertRedirect('login');
    }

    /** @test */
    public function allTasksAvailableOnTasksPage()
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
    public function taskBelongsToCreator()
    {
        $task = factory('App\Task')->create();

        $this->assertInstanceOf(User::class, $task->creator);
    }

    /** @test */
    public function taskBelongsToAsignedUser()
    {
        $task = factory('App\Task')->create();

        $this->assertInstanceOf(User::class, $task->assignedTo);
    }

    /** @test */
    public function taskBelongsToStatus()
    {
        factory('App\Status')->create();
        $task = factory('App\Task')->create();

        $this->assertInstanceOf(Status::class, $task->status);
    }

    /** @test */
    public function singleTaskAvailableOnTaskPage()
    {
        $this->signIn();

        $task = factory('App\Task')->create();
        factory('App\Status')->create();

        $this->get(route('tasks.show', $task))
            ->assertStatus(200)
            ->assertSee($task->name);
    }

    /** @test */
    public function authUsersCanCreateTasks()
    {
        $this->signIn();

        $this->get(route('tasks.create'))->assertStatus(200);

        $assigned = factory('App\User')->create();

        $this->post(route('tasks.store'), $attributes = ['name' => 'Test task', 'assigned_id' => $assigned->id]);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    /** @test */
    public function authUsersCanUpdateOwnTasks()
    {
        $user = $this->signIn();

        $task = factory('App\Task')->create(['creator_id' => auth()->id()]);

        $this->get(route('tasks.edit', $task))->assertStatus(200);

        $attributes = ['name' => 'Updated task', 'description' => 'Changed', 'assigned_id' => $task->assigned_id];

        $this->patch(route('tasks.update', $task), $attributes);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    /** @test */
    public function authUsersCanDeleteOwnTasks()
    {
        $user = $this->signIn();

        $task = factory('App\Task')->create(['creator_id' => auth()->id()]);

        $this->delete(route('tasks.destroy', $task));

        $this->assertDatabaseMissing('tasks', $task->toArray());
    }

    /** @test */
    public function authUsersCannotUpdateOtherTasks()
    {
        $this->signIn();

        $task = factory('App\Task')->create();

        $this->get(route('tasks.edit', $task))->assertStatus(403);
    }

    /** @test */
    public function authUsersCannotDeleteOtherTasks()
    {
        $this->signIn();

        $task = factory('App\Task')->create();

        $this->delete(route('tasks.destroy', $task))->assertStatus(403);
    }

    /** @test */
    public function tasksCanSyncWithTags()
    {
        $task = factory('App\Task')->create();

        $tags = factory('App\Tag', 2)->create();

        $task->tags()->sync($tags->pluck('id')->toArray());

        $this->assertEquals(2, $task->tags->count());
    }
}
