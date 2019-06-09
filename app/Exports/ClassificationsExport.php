<?php

namespace App\Exports;

use App\Classification;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassificationsExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Classification::all();
    }
     public function headings(): array
    {
        return [
            'id',
            'uuid',
            'Code',
            'المصطلح الانكليزي', 
            'classification_level',
            'المصطلح العربي',
            'parent_id',
            'parent_code',
            'الحالة',
            'ملاحظات الجريعة اليومية',
            'تاريخ الانشاء',
            'تاريخ التعديل'
        ];
    }
}
