<?php

namespace App\Exports;

use App\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompaniesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'uuid',
            'en_name',
            'ar_name',
            'ar_article',
            'en_article',
            'location',
            'company_logo',
            'status_id',
            'created_at',
            'updated_at'
        ];
    }
}
