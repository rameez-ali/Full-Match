<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Videocategory extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'id','video_id','category_id',
    ];
     protected $dates = ['deleted_at'];

}
