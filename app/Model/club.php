<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class club extends Model
{
    protected $fillable = [
        'club_name','club_banner','club_logo','club_description',
    ];
}
