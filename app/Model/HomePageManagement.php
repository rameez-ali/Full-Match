<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomePageManagement extends Model
{
    use SoftDeletes;
    protected $table = 'home_page_managements';
}
