<?php

namespace App\Mail;

use App\Models\Colocation;
use App\Models\Invetation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Invetation $invetation;

    public function __construct(Invetation $invetation)
    {
        $this->invetation = $invetation;
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
                'invetation' => $this->invetation,
                'colocation' => $this->invetation->colocation,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
