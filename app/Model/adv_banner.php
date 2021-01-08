<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Adv_banner extends Model
{
    protected $fillable = [
        'id','video_title','video_banner','video_link','category_id','genre_id','homepage',
    ];
  
}
