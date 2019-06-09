<?php

namespace App\Exports;

use App\Composition;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompositionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Composition::all();
    }
}
