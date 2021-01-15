<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Adv_banner extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'id','video_title','video_banner','video_link','category_id','genre_id','homepage',
    ];
     protected $dates = ['deleted_at'];
  
}
