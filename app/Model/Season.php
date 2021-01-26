<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
	use SoftDeletes;
    protected $fillable = ['league_id', 'name_en','Video'];
    protected $dates = ['deleted_at'];
}
