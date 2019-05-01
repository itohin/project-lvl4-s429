<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function filter_by_assigned_user()
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
    public function filter_by_auth_user()
    {
        $user = factory('App\User')->create(['name' => 'John Doe']);

        factory('App\Status')->create();
        $taskByJohn = factory('App\Task')->create(['creator_id' => $user->id]);
        $taskNotByJohn = factory('App\Task')->create();

        $this->get('/tasks?by=' . $user->slug)
            ->assertSee($taskByJohn->name)
            ->assertDontSee($taskNotByJohn->name);
    }

}
