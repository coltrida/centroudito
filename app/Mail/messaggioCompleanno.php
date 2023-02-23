<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class messaggioCompleanno extends Mailable
{
    use Queueable, SerializesModels;
    public $compleanno;

    /**
     * Create a new message instance.
     *
     * @param Client $compleanno
     */
    public function __construct(Client $compleanno)
    {
        $this->compleanno = $compleanno;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.messaggioCompleanno');
    }
}
