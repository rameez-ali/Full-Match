<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subs_plan extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'duration_type', 'duration_value','plan_title_ar','plan_Description_ar',
    ];
}
