<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class inviaMessaggio extends Mailable
{
    use Queueable, SerializesModels;
    public $testoMessaggio;
    public $client;

    /**
     * Create a new message instance.
     *
     * @param $testoMessaggio
     * @param array $client
     */
    public function __construct($testoMessaggio, array $client)
    {
        $this->testoMessaggio = $testoMessaggio;
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Informazione Centro Udito')->markdown('mails.inviaMessaggio');
    }
}
