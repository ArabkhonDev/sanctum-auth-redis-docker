<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PostCreated
{
    use Dispatchable, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
        Log::info('PostCreated event ishladi: ', ['post_id' => $post->id]);
    }
}
