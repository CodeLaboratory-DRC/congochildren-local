<?php

namespace App\Exports;

use App\Models\Agricole;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;

class AgricoleExport implements FromView
{
    public function view(): View
    {
        return view('exports.agricoles', [
            'agricoles' => Agricole::where('agricoles.is_deleted', '=', false)->get()
        ]);
    }
    
}
