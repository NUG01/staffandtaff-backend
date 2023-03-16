<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->from($this->user['email'])->to(env('MAIL_USERNAME'))
            ->subject($this->user['sms'])
            ->view('mail.userMail', ['name' => $this->user['name'], 'email' => $this->user['email'], 'sms' => $this->user['sms']]);
    }


}
