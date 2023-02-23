<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlarmRootPrincipale extends Mailable
{
    use Queueable, SerializesModels;

    public $valori;

    /**
     * Create a new message instance.
     *
     * @param $valori
     */
    public function __construct($valori)
    {
        $this->valori = $valori;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.alarmRootPrincipale');
    }
}
