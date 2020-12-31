<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'Category_id','video_title','video_banner_img','video_img','video_description',
        'video_link','video_duration','notify_user',
    ];
    protected $dates = ['deleted_at'];
}
