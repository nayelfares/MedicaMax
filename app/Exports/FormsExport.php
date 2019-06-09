<?php

namespace App\Exports;

use App\Form;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Form::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'uuid',
            'Code',
            'en_name',
            'ar_name',
            'parent_id',
            'parent_code',
            'form_unit',
            'amount',
            'status_id',
            'created_at',
            'updated_at'
        ];
    }
}