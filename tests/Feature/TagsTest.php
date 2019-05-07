<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authUserCanCreateTag()
    {
        $this->signIn();

        $this->get(route('tags.create'))->assertStatus(200);

        $this->post(route('tags.store'), $attributes = ['name' => 'New']);

        $this->assertDatabaseHas('tags', $attributes);
    }

    /** @test */
    public function authUserCanUpdateTag()
    {
        $this->signIn();

        $tag = factory('App\Tag')->create();

        $this->get(route('tags.edit', $tag))->assertStatus(200);

        $this->patch(route('tags.update', $tag), $attributes = ['name' => 'Changed']);

        $this->assertDatabaseHas('tags', $attributes);
    }

    /** @test */
    public function authUserCanDeleteTag()
    {
        $this->signIn();

        $tag = factory('App\Tag')->create();

        $this->delete(route('tags.destroy', $tag));

        $this->assertDatabaseMissing('tags', $tag->toArray());
    }
}
