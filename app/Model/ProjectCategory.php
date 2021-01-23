<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProjectCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name_en','name_ar','category_image','category_sorting',
    ];

    protected $dates = ['deleted_at'];
}
