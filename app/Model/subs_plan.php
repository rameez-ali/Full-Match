<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class subs_plan extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'duration_type', 'duration_value',
    ];
}
