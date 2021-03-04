<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponseMailClass extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$contactmessages)
    {
        $this->name=$name;
        $this->contactmessages=$contactmessages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->name,$this->message);
        return $this->view('admin.responseemail.mail',['name' => $this->name,'contactmessages' => $this->contactmessages]);
    }
}
