<?php

namespace App\Exports;

use App\Models\Localite;
use Maatwebsite\Excel\Concerns\FromCollection;

class LocaliteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Localite::all();
    }
}
