<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Videogenre extends Model
{
     protected $fillable = [
        'video_id','genre_id','deleted_at',
    ];
}
