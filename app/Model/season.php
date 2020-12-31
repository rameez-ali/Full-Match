<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
	use SoftDeletes;
    protected $fillable = ['Project_id', 'Seasons','Video'];
    protected $dates = ['deleted_at'];
}
