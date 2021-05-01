<?php

namespace App\Exports;

use App\Model\Video;
use App\Model\Videoplayer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PlayerVideosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection


    */

     use Exportable;

    public function __construct(array $name)
    {
        $this->name = $name;
    }

    

    public function collection()
    {
         $videoplayer=Videoplayer::select('Video_id')->wherein('Player_id',$this->name)->get();
        return Video::select('title_en','description_en','video_link','video_sorting')->wherein('id', $videoplayer)->get();
    }

     public function headings(): array
    {
        return [
            'Title',
            'description',
            'Link',
            'Sorting',
        ];
    }
}
