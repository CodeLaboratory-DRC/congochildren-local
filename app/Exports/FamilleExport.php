<?php

namespace App\Exports;

use App\Models\Famille;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class FamilleExport implements FromView
{
    public function view(): View
    {
        return view('exports.familles', [
            'families' => Famille::all()
        ]);
    }
}
