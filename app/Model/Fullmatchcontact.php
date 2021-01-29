<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Fullmatchcontact extends Model
{
    protected $fillable = [
        'call_us','email_us','address_en','address_ar',
    ];

}
