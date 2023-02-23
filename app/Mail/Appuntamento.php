<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Appuntamento extends Mailable
{
    use Queueable, SerializesModels;
    public $client;
    public $appuntamento;

    /**
     * Create a new message instance.
     *
     * @param Client $client
     * @param \App\Models\Appuntamento $appuntamento
     */
    public function __construct(Client $client, \App\Models\Appuntamento $appuntamento)
    {
        $this->client = $client;
        $this->appuntamento = $appuntamento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Appuntamento Centro Udito')->markdown('mails.appuntamento');
    }
}
