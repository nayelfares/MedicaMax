<?php

namespace App\Exports;

use App\Dictionary;
use Maatwebsite\Excel\Concerns\FromCollection;

class DictionayExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dictionary::all();
    }
}
