<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class EmailVerificationNotification extends Mailable
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
            $url = 'verification.verify';
        }else{
            $url = 'customer.verification.verify';
        }

        $data = [
            'id' => $this->user->id , 
            'hash' => sha1($this->user->email)
        ];

        $carbon = Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60));

        $route = URL::temporarySignedRoute($url,$carbon,$data);        

        return $this->view('emails.user-registered',['route' => $route]);
    }   
}
