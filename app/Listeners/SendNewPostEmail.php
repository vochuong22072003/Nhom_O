<?php

namespace App\Listeners;

use App\Events\AuthorAddPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPostEmail;

class SendNewPostEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AuthorAddPost $event): void
    {
        Mail::to($event->customer_emails)->send(new NewPostEmail($event->post, $event->author_name));
    }
}
