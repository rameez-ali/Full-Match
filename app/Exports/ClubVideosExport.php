<?php

namespace App\Exports;

use App\Model\Video;
use App\Model\Videoclub;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ClubVideosExport implements FromCollection, WithHeadings
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
        $videoclub=Videoclub::select('Video_id')->wherein('Club_id',$this->name)->get();
        return Video::select('title_en','description_en','video_link','video_sorting')->wherein('id', $videoclub)->get();
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
