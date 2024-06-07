<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_list_all_posts()
    {
        $user = User::factory()->create();
        $posts = Post::factory()->count(5)->for($user)->create();

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function can_filter_posts_by_tag()
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create(['name' => 'PHP']);
        $postsWithTag = Post::factory()->count(3)->for($user)->create();
        $postsWithTag->each(function ($post) use ($tag) {
            $post->tags()->attach($tag->id);
        });

        $response = $this->getJson('/api/posts?tags=PHP');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /** @test */
    public function returns_empty_if_no_posts_with_tag()
    {
        $response = $this->getJson('/api/posts?tag=NonExistentTag');

        $response->assertStatus(200)
                 ->assertJsonCount(0, 'data');
    }
}
