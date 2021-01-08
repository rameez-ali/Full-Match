<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video_genre extends Model
{
     protected $fillable = [
        'genre_name','genre_sorting','deleted_at',
    ];
}
