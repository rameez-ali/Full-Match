<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'id','category_id','name_en','name_ar','slider_sorting',
    ];
    protected $dates = ['deleted_at'];
}
