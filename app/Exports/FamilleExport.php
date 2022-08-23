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
            'families' => Famille::select(
                    'familles.nom_pere',
                    'familles.nom_mere',
                    'familles.instruction_pere',
                    'familles.instruction_mere',
                    'familles.matrimonial',
                    'familles.nb_enfant',
                    'familles.nb_homme',
                    'familles.nb_femme',
                    'familles.revenu_jour',
                    'familles.activite_princ',
                    'familles.activite_sec',
                    'familles.nb_enfant_mine',
                    'sites.nom as nomSite'
            )
                ->join('enfants', 'familles.enfant_id', 'enfants.id')
                ->join('sites', 'sites.id', 'enfants.site_id')
                ->where('enfants.is_deleted', false)
                ->groupBy('familles.nom_mere')
                ->orderBy('nomSite')
                ->get(),
        ]);
    }
}
