<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailWelcome extends Mailable
{
    use Queueable, SerializesModels;

    protected $aboutUs;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($about_us)
    {
        $this->aboutUs = $about_us;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('layouts.email.welcomeEmail', [
            'about_us' => $this->aboutUs
        ])->subject("Registration Success! Welcome to Verve");
    }
}
