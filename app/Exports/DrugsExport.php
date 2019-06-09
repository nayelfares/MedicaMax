<?php

namespace App\Exports;

use App\Drug;
use Maatwebsite\Excel\Concerns\FromCollection;

class DrugsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Drug::all();
    }
}
