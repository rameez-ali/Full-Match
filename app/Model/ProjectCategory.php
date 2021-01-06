<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProjectCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_name','category_image','category_sorting',
    ];

    protected $dates = ['deleted_at'];
}
