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
    public function __construct($name,$message)
    {
        $this->name=$name;
        $this->message=$message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build($name,$message)
    {
        // dd($this->name,$this->message);
        return $this->view('admin.responseemail.mail',compact('name'=>$this->name));
    }
}
