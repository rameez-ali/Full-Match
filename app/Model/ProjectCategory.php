<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $fillable = [
        'category_name','featured_image',
    ];
}
