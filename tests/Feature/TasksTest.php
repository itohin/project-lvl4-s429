<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function all_tasks_available_on_tasks_page()
    {
        $this->get(route('tasks.index'))
            ->assertStatus(200)
            ->assertSee('No tasks yet.');

        $task = factory('App\Task')->create();

        $this->get(route('tasks.index'))
            ->assertStatus(200)
            ->assertSee($task->name);
    }

    /** @test */
    public function single_task_available_on_task_page()
    {
        $task = factory('App\Task')->create();

        $this->get(route('tasks.show', $task))
            ->assertStatus(200)
            ->assertSee($task->name);
    }
}
