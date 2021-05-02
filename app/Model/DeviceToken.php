<?php

namespace App\Model;

use App\customer;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    protected $fillable = [
        'device','token','user_id','lang',
    ];

    public function checknotify()
    {
        return $this->belongsTo(customer::class , 'user_id', 'user_id');
    }
}
