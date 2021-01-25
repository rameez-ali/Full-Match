<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video_genre extends Model
{
	use SoftDeletes;
     protected $fillable = [
        'name_en','name_ar','genre_sorting',
    ];
    protected $dates = ['deleted_at'];
}
