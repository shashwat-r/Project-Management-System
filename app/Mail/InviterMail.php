<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $receiver;
    public $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->sender = $data['sender'];
        $this->receiver = $data['receiver'];
        $this->project = $data['project'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.sender');
    }
}
