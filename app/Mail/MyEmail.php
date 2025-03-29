<?php
// app/Mail/MyEmail.php

namespace app\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;


    /**
     * Create a new message instance.
     *
     *
     * @param  array    The form data to be included in the email
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.emailSent')
            ->subject($this->details['title']) // Set the subject
            ->from('qistitesting1212@gmail.com', 'MUHAMMAD QISTI AMALUDDIN BIN MOHD ROZAINI'); // Set the sender email and name
    }
}

