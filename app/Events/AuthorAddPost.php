<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Post;
use App\Models\User;

class AuthorAddPost
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Post $post,
        public User $author,
        // public array $customer_emails = $this-> getEmailFollowers(),
    ) {}

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
    public function getEmailFollowers(){

        $followers = $this->author->followers;
        $emails = [];

        foreach($followers as $f) {
            array_push($emails, $f->email);
        }
        
        return $emails;
    }
}
