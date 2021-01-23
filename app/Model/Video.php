<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'Category_id','leagues_id','video_title','video_banner_img','video_img','video_description',
        'video_link','hour','minute','second','notify_user','video_sorting','popular_searches','video_promo',
    ];
//    protected $dates = ['deleted_at'];
}
