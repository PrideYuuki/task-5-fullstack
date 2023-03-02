<?php

namespace Tests\Feature;

use App\Models\Articles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->seed();
    }

    public function testGetAllPosts()
    {
        $response = $this->get('/api/v1/posts');
        $response->assertStatus(200);
    }

    public function testCreatePost()
    {
        $data = [
            'title' => 'Lorem ipsum dolor sit amet',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ];
        $response = $this->post('/api/v1/posts', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', $data);
    }

    public function testGetPostById()
    {
        $post = Articles::factory()->create();
        $response = $this->get('/api/v1/posts/' . $post->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->content
        ]);
    }

    public function testUpdatePost()
    {
        $post = Articles::factory()->create();
        $data = [
            'title' => 'Updated Title',
            'content' => 'Updated Content'
        ];
        $response = $this->put('/api/v1/posts/' . $post->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $data);
    }

    public function testDeletePost()
    {
        $post = Articles::factory()->create();
        $response = $this->delete('/api/v1/posts/' . $post->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
