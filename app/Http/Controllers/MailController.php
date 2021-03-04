<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail

class MailController extends Controller
{
  
   public function basic_email() {
      $data = array('name'=>"Rameez");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('rameezali1995@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('ammad1194@gmail.com','Ammad');
      });
      echo "Basic Email Sent. Check your inbox.";
   }

}
