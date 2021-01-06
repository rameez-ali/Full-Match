<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'club_name','club_banner','club_logo','club_description','club_sorting',
    ];
    protected $dates = ['deleted_at'];
}
