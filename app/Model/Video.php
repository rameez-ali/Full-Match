<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'category_id','league_id','season_id','title_en','title_ar','video_banner_img','video_img','description_en','description_ar',
        'video_link','video_link1','video_link2','video_link3','video_id','duration','notify_user','video_sorting','popular_searches','video_promo',
    ];
//    protected $dates = ['deleted_at'];

    public function mylist()
    {
        return $this->hasOne(My_wish_list::class , 'video_id');
    }
}
