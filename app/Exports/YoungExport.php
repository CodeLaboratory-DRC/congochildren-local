<?php

namespace App\Exports;

use App\Models\Enfant;
use App\Models\Famille;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class YoungExport implements FromView
{
    public function view(): View
    {
        return view('exports.youngs', [
            'youngers' => Enfant::select(
                'familles.nom_pere',
                'familles.nom_mere',
                'familles.instruction_pere',
                'familles.instruction_mere',
                'enfants.nom',
                'enfants.age',
                'enfants.genre',
                'enfants.adresse',
                'enfants.parent_vie',
                'enfants.deplace',
                'enfants.habitation',
                'enfants.rang_famille',
                'scolarites.etude',
                'scolarites.niveauEtude',
                'scolarites.chargeFrais',
                'scolarites.travailEtude',
                'scolarites.horaire',
                'scolarites.frequentation',
                'enquetes.debut',
                'enquetes.travail_ant',
                'enquetes.ameneur',
                'enquetes.occupation',
                'enquetes.motivation',
                'enquetes.satisfaction',
                'enquetes.maladie',
                'enquetes.accident',
                'enquetes.soin',
                'enquetes.distance_soin',
                'enquetes.distance_mine',
                'enquetes.patron',
                'enquetes.abandonner',
                'enquetes.autre_activite',
                'jeunes.etat_civil',
                'jeunes.coinjoint',
                'jeunes.nb_enfant',
                'jeunes.nb_garcon',
                'jeunes.nb_fille',
                'jeunes.nb_scolarise'
            )->join('familles', 'enfants.id', 'familles.enfant_id')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->join('jeunes', 'enfants.id', 'jeunes.enfant_id')
                ->join('enquetes', 'enfants.id', 'enquetes.enfant_id')
                ->where('enfants.is_deleted', '=', false)
                ->where('age', '>', 17)->get()
        ]);
    }
}
