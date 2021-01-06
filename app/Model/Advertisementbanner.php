<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisementbanner  extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'id','Category_id','slider_name',
    ];
    protected $dates = ['deleted_at'];
}
