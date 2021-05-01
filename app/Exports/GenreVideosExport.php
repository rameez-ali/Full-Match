<?php

namespace App\Exports;

use App\Model\Video;
use App\Model\Videogenre;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class GenreVideosExport implements FromCollection, WithHeadings
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
         $videogenre=Videogenre::select('video_id')->wherein('genre_id',$this->name)->get();
        return Video::select('title_en','description_en','video_link','video_sorting')->wherein('id', $videogenre)->get();
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
