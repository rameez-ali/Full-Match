<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class My_wish_list extends Model
{
    public function wishlistvideo()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
