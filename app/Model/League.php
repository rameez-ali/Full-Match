<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class League extends Model
{
	use SoftDeletes;
    protected $fillable = ['league_name','league_banner','league_promo_video','league_profile_image','league_description','league_sorting'];
    protected $dates = ['deleted_at'];

}
