<?php

namespace App\Exports;

use App\Models\Miniere;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MiniereExport implements FromView
{
    public function view(): View
    {
        return view('exports.mines', [
            'mines' => Miniere::where('minieres.is_deleted', '=', false)->all()
        ]);
    }
}
