<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = '';

        if(request()->segment(1) == 'admin'){
            $url = 'password.reset';
        }else{
            $url = 'customer.password.reset';
        }

        $route = route($url,['token' => $this->user->token]);

        return $this->view('emails.reset-password',['route' => $route]);        
    }
}