<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_all_posts()
    {
        // Fake postlar yaratamiz
        Post::factory()->count(5)->create();

        // API chaqiramiz
        $response = $this->getJson('/api/posts');

        // Status kod 200 bo‘lishi kerak
        $response->assertStatus(200);

        // dd($response->json());
        $response->assertJsonStructure(['data']); // 'data' mavjudligini tekshirish

        // Postlar soni 5 bo‘lishini tekshiramiz
        $response->assertJsonCount(5, 'data');
    }
}