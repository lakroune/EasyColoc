<?php

namespace App\Mail;

use App\Models\Colocation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Colocation $colocation;

    public function __construct(Colocation $colocation)
    {
        $this->colocation = $colocation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitation EasyColoc'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invitation',
            with: [
                'inviteLink' => $this->colocation->token,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
