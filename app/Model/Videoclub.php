<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Videoclub extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'Club_id','Video_id','category_id'
    ];
    protected $dates = ['deleted_at'];
}
