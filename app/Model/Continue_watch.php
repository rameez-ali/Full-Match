<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Continue_watch extends Model
{

    protected $fillable = [
        'user_id','video_id','name','name_ar','image','link','duration','position',
    ];

}
