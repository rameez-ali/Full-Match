<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;


class Category_genre extends Model
{
	// use SoftDeletes;
    protected $fillable = [
        'category_id','genre_id',
    ];
     // protected $dates = ['deleted_at'];
  
}
