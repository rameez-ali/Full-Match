<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slidercategory1 extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'id','Category_id','slider_name','slider_sorting',
    ];
    protected $dates = ['deleted_at'];
}
