<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    protected $fillable = [
        'device','token','user_id',
    ];
}
