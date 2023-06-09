<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Videoplayer extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'Player_id','Video_id','category_id',
    ];
    protected $dates = ['deleted_at'];
}
