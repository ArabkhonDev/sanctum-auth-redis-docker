<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPostNotification implements ShouldQueue
{
    public function handle(PostCreated $event)
    {
        // Foydalanuvchilarga xabar yuborish
        Mail::raw("Yangi post yaratildi: " . $event->post->title, function ($message) {
            $message->to('starc9899@gmail.com')->subject('Yangi Post');
        });
        Log::info('SendPostNotification listener ishladi: ', ['post_id' => $event->post->id]);
    }
}
