<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_can_list_all_tags()
    {
        Tag::factory()->count(5)->create();

        $response = $this->getJson('/api/tags');

        $response->assertStatus(200)
                 ->assertJsonCount(5);
    }

    // /** @test */
    // public function it_can_create_a_tag()
    // {
    //     $data = [
    //         'name' => 'New Tag'
    //     ];

    //     $response = $this->postJson('/api/tags', $data);

    //     $response->assertStatus(201)
    //              ->assertJsonFragment($data);
        
    //     $this->assertDatabaseHas('tags', $data);
    // }

    // /** @test */
    // public function it_validates_tag_creation()
    // {
    //     $response = $this->postJson('/api/tags', []);

    //     $response->assertStatus(400)
    //              ->assertJsonValidationErrors(['name']);
    // }

    // /** @test */
    // public function it_can_show_a_tag()
    // {
    //     $tag = Tag::factory()->create();

    //     $response = $this->getJson('/api/tags/'.$tag->id);

    //     $response->assertStatus(200)
    //              ->assertJsonFragment(['name' => $tag->name]);
    // }

    // /** @test */
    // public function it_returns_404_if_tag_not_found()
    // {
    //     $response = $this->getJson('/api/tags/999');

    //     $response->assertStatus(404);
    // }

    // /** @test */
    // public function it_can_update_a_tag()
    // {
    //     $tag = Tag::factory()->create();

    //     $data = [
    //         'name' => 'Updated Tag Name'
    //     ];

    //     $response = $this->putJson('/api/tags/'.$tag->id, $data);

    //     $response->assertStatus(200)
    //              ->assertJsonFragment($data);

    //     $this->assertDatabaseHas('tags', $data);
    // }

    // /** @test */
    // public function it_validates_tag_update()
    // {
    //     $tag = Tag::factory()->create();

    //     $response = $this->putJson('/api/tags/'.$tag->id, []);

    //     $response->assertStatus(400)
    //              ->assertJsonValidationErrors(['name']);
    // }

    // /** @test */
    // public function it_can_delete_a_tag()
    // {
    //     $tag = Tag::factory()->create();

    //     $response = $this->deleteJson('/api/tags/'.$tag->id);

    //     $response->assertStatus(204);

    //     $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    // }
}
