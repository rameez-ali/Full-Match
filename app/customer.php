<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    public function user()
    {
        return $this->hasOne(User::class,'id');
    }
}
