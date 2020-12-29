<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'Category_id','video_title','video_banner_img','video_img','video_description',
        'video_link','video_duration','notify_user',
    ];
}
