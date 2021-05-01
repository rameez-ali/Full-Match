<?php

namespace App\Exports;

use App\Model\Video;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CategoryVideosExport implements FromCollection, WithHeadings
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
        return Video::select('title_en','description_en','video_link','video_sorting')->wherein('category_id', $this->name)->get();
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
