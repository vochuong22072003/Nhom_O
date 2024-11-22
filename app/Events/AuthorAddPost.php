<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AuthorAddPost
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The post instance added
     * @var \App\Models\Post
     */
    public $post;
    /**
     * The name author 
     * @var string
     */
    public $author_name;
    /**
     * Customer emails who have followed the author
     * @var array<string> 
     */
    public $customer_emails;

    public function __construct($post, $author_name, $customer_emails)
    {
        $this->post = $post;
        $this->author_name = $author_name;
        $this->customer_emails = $customer_emails;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
