<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slidercategory1 extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'id','slider_name',
    ];
    protected $dates = ['deleted_at'];
}
