<?php

namespace App\Exports;

use App\ChemicalComposition;
use Maatwebsite\Excel\Concerns\FromCollection;

class ChemicalCompositionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ChemicalComposition::all();
    }
}
