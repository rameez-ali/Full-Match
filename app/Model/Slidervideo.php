<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slidervideo extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'Video_id','Slider_id',
    ];
    protected $dates = ['deleted_at'];
}
