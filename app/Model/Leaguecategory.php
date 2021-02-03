<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leaguecategory extends Model
{
	use SoftDeletes;
    protected $fillable = ['video_id','league_id','category_id',];
    protected $dates = ['deleted_at'];

}
