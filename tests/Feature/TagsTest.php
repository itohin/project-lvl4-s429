<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function auth_user_can_create_tag()
    {
        $this->signIn();

        $this->get(route('tags.create'))->assertStatus(200);

        $this->post(route('tags.store'), $attributes = ['name' => 'New']);

        $this->assertDatabaseHas('tags', $attributes);
    }

    /** @test */
    public function auth_user_can_update_tag()
    {
        $this->signIn();

        $tag = factory('App\Tag')->create();

        $this->get(route('tags.edit', $tag))->assertStatus(200);

        $this->patch(route('tags.update', $tag), $attributes = ['name' => 'Changed']);

        $this->assertDatabaseHas('tags', $attributes);
    }

    /** @test */
    public function auth_user_can_delete_tag()
    {
        $this->signIn();

        $tag = factory('App\Tag')->create();

        $this->delete(route('tags.delete', $tag));

        $this->assertDatabaseMissing('tags', $tag->toArray());
    }
}
