<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $fillable = ['Category_id','League_Name','League_Description','league_banner','league_promo_video','league_profile_image'];

}
