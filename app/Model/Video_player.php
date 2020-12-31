<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video_player extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'Player_id','Video_id',
    ];
    protected $dates = ['deleted_at'];
}
