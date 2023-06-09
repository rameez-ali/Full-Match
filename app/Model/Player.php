<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'name_en','name_ar','player_banner','player_profile_image','description_en','description_ar','player_sorting',
    ];
    protected $dates = ['deleted_at'];
}
