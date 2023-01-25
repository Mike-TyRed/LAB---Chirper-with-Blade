<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $sunject = "Informacion de contacto";
    public function __construct()
    {
        //
    }
 
    public function envelope()
    {
        return new Envelope(
            subject: 'Notification Mailable',
        );
    }
 
    public function content()
    {
        return new Content(
            view: 'emails.contact',
        );
    }
 
    public function attachments()
    {
        return [];
    }
}
