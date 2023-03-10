<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */


    public function __construct($data)
    {
        $this->data = $data;
    }


    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Email Verification')
            ->view('mail.register', ['name' => $this->data['name'], 'email' => $this->data['email'], 'url' => $this->data['url']]);
    }
}
