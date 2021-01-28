<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class My_wish_list extends Model
{
    protected $fillable = [
        'user_id','video_id',
    ];
}
