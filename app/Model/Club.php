<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'name_en','name_ar','club_banner','club_logo','description_en','description_ar','club_sorting',
    ];
    protected $dates = ['deleted_at'];
}
