<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function filterByAssignedUser()
    {
        $assignedUser = factory('App\User')->create(['name' => 'John Doe']);

        factory('App\Status')->create();
        $taskAssignedTo = factory('App\Task')->create(['assigned_id' => $assignedUser->id]);
        $taskNotAssignedTo = factory('App\Task')->create();

        $this->get('/tasks?assigned=' . $assignedUser->slug)
            ->assertSee($taskAssignedTo->name)
            ->assertDontSee($taskNotAssignedTo->name);
    }

    /** @test */
    public function filterByAuthUser()
    {
        $user = factory('App\User')->create(['name' => 'John Doe']);

        factory('App\Status')->create();
        $taskByJohn = factory('App\Task')->create(['creator_id' => $user->id]);
        $taskNotByJohn = factory('App\Task')->create();

        $this->get('/tasks?by=' . $user->slug)
            ->assertSee($taskByJohn->name)
            ->assertDontSee($taskNotByJohn->name);
    }

    /** @test */
    public function filterByStatus()
    {
        $statusNew = factory('App\Status')->create(['name' => 'new']);
        $statusTest = factory('App\Status')->create(['name' => 'test']);

        $taskNew = factory('App\Task')->create(['status_id' => $statusNew->id]);
        $taskTest = factory('App\Task')->create(['status_id' => $statusTest->id]);

        $this->get('/tasks?status=' . $statusNew->id)
            ->assertSee($taskNew->name)
            ->assertDontSee($taskTest->name);
    }

    /** @test */
    public function filterByTag()
    {
        $tagFirst = factory('App\Tag')->create(['name' => 'first']);
        $tagSecond = factory('App\Tag')->create(['name' => 'second']);

        factory('App\Status')->create();
        $taskFirst = factory('App\Task')->create();
        $taskSecond = factory('App\Task')->create();

        $taskFirst->tags()->sync($tagFirst->id);
        $taskSecond->tags()->sync($tagSecond->id);

        $this->get('/tasks?tag=' . $tagFirst->id)
            ->assertSee($taskFirst->name)
            ->assertDontSee($taskSecond->name);
    }
}
