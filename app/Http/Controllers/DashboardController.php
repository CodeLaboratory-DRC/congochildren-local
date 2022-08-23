<?php

namespace App\Http\Controllers;

use App\Models\Agricole;
use App\Models\Enfant;
use App\Models\Famille;
use App\Models\Fournisseur;
use App\Models\Miniere;
use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $sites = Site::all();
        return view('dashboard', compact('sites'));
    }

    public function countProvince()
    {
        $total = Enfant::countLocal(null, 'haut-katanga');
        $jeune = Enfant::countLocal('jeune', 'haut-katanga');
        $enfant = Enfant::countLocal('enfant', 'haut-katanga');
        $famille = Famille::countLocal('haut-katanga');
        $miniere = Miniere::countLocal('haut-katanga');
        $agricole = Agricole::countLocal('haut-katanga');
        $agrobusiness = Fournisseur::countLocal('agrobusiness', 'haut-katanga');
        $fournisseur = Fournisseur::countLocal('fournisseur', 'haut-katanga');

        return [
            'total' => $total,
            'jeune' => $jeune,
            'enfant' => $enfant,
            'famille' => $famille,
            'miniere' => $miniere,
            'agricole' => $agricole,
            'agrobusiness' => $agrobusiness,
            'fournisseur' => $fournisseur,
        ];
    }

    public function test($province)
    {
        $enfants = Enfant::select(
            'enfants.id',
            'enfants.nom',
            'enfants.age',
            'enfants.genre',
            'enfants.adresse',
            'enfants.parent_vie',
            'enfants.deplace',
            'enfants.habitation',
            'enfants.rang_famille',
            'enfants.site_id',
            'enfants.user_id'
        )
            ->join('familles', 'enfants.id', 'familles.enfant_id')
            ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
            ->join('enquetes', 'enfants.id', 'enquetes.enfant_id')
            ->where('age', '<', 18)
            ->where('is_deleted', false)
            ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille');
    }
}
