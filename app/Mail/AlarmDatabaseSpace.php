<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\Float_;
use phpDocumentor\Reflection\Types\Integer;

class AlarmDatabaseSpace extends Mailable
{
    use Queueable, SerializesModels;
    public $spazioUtilizzato;

    /**
     * Create a new message instance.
     *
     * @param float $spazioUtilizzato
     */
    public function __construct( $spazioUtilizzato)
    {
        $this->spazioUtilizzato = $spazioUtilizzato;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.alarmDatabaseSpace');
    }
}
