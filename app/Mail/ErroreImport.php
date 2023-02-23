<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ErroreImport extends Mailable
{
    use Queueable, SerializesModels;
    public $messaggio;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param $messaggio
     * @param $user
     */
    public function __construct($messaggio, $user)
    {
        $this->messaggio = $messaggio;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.erroreImport');
    }
}
