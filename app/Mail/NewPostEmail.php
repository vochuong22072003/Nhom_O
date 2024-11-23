<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use \App\Models\Post;
use App\Http\Controllers\Controller;

class NewPostEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *  __construct
     * @param \App\Models\Post $post
     * @param string $author_name
     */
    public function __construct(
        public Post $post,
        public string $author_name,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New post from: ' . $this->author_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $encr_id = (new Controller)->encryptId($this->post->id);
        return new Content(
            view: 'emails.new-post',
            with: ['url' => route('client.detail', ['id' => $encr_id ])]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
