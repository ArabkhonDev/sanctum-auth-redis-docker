<?php
namespace Tests\Feature;

use App\Events\PostCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\Models\Post;

class PostEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_created_event_fires()
    {
        Event::fake(); // Eventlarni soxtalashtirish

        $post = Post::create([
            'title' => 'Event Test',
            'content' => 'Event ishladimi?',
        ]);

        Event::assertDispatched(PostCreated::class);
    }
}
