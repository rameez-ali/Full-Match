<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class League extends Model
{
	use SoftDeletes;
    protected $fillable = ['name_en','name_ar','league_banner','league_promo_video','league_profile_image','description_en','description_ar','league_sorting'];
    protected $dates = ['deleted_at'];

}
