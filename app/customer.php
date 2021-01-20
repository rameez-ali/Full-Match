<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = [
        'name', 'email', 'user_id', 'user_image', 'notify_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
