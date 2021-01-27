<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HomePgItem extends Model
{
    public $timestamps = false;

    public function homemanage()
    {
        return $this->belongsTo(HomePageManagement::class, 'section_id');
    }
    protected $fillable = [
        'section_id','item_name','item_id',
    ];
}
