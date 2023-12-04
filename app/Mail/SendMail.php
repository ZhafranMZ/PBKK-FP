<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $type;
    /**
     * Create a new message instance.
     */
    public function __construct($type)
    {
        $this->type = $type;
    }
    /**
    * Build the message.
    *
    * @return $this
    */
    public function build()
    {
        $data = $this->type;
        // dd($data);
        return $this->view('emails.template', ['pesan' => $this->type]);
    }
}
