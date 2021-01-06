<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'player_name','player_banner','player_profile_image','player_description','player_sorting',
    ];
    protected $dates = ['deleted_at'];
}
