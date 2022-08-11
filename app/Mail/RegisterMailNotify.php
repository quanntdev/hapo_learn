<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMailNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $code;
    /**
     * Create a new data instance.
     *
     * @return void
     */

    public function __construct($data, $code)
    {
        $this->data = $data;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $code = $this->code;
        return $this->from(config('email.email'))
            ->view('mail.index')
            ->with(compact('data', 'code'))
            ->subject(config('email.subject'));
    }
}
