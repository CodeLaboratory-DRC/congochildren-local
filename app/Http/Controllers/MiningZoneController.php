<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Enfant;
use App\Models\Contact;
use App\Models\Miniere;
use App\Models\Agricole;
use App\Models\Localite;
use App\Models\Communaute;
use App\Models\Fournisseur;
use App\Models\AgroBusiness;
use Illuminate\Http\Request;

class MiningZoneController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index($localite)
    {
        $sites = Site::where('localite', $localite)->get();
        $localite = Site::where('localite', $localite)->first();

        return view('mining_zone.mining_zone_list', compact('sites', 'localite'));
    }


    /**
     * Display the specified resource
     *
     * @param  \App\Models\site  $site
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $site = Site::find($id);

        $children = Enfant::select('enfants.id',
            'enfants.nom',
            'enfants.age',
            'enfants.genre',
            'enfants.adresse',
            'enfants.parent_vie',
            'enfants.deplace',
            'enfants.habitation',
            'enfants.rang_famille',
            'enfants.site_id',
            'enfants.user_id')
            ->join('familles', 'enfants.id', 'familles.enfant_id')
            ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
            ->join('enquetes', 'enfants.id', 'enquetes.enfant_id')
            ->where('enfants.site_id', $id)
            ->where('enfants.is_deleted', '=', false)
            ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
            ->orderBy('enfants.nom')
            ->get();

        $mines = Miniere::where('sites_id', $id)->get();

        $agricoles = Agricole::where('sites_id', $id)->get();

        $fournisseurs = Contact::select(
            'fournisseurs.id',
            'fournisseurs.sites_id',
            'fournisseurs.nom',
            'fournisseurs.categorisation',
            'fournisseurs.nomGerant',
            'fournisseurs.domaine',
            'fournisseurs.statutJuridique',
            'fournisseurs.users_id',
            'contacts.adresse',
            'contacts.telephone'
        )
            ->join('fournisseurs', 'fournisseurs.id', 'contacts.id_table')
            ->where('contacts.nomTable', 'fournisseurs')
            ->where('sites_id', $id)
            ->where('categorisation', 'fournisseur')
            ->get();

        $agrobusinesses = Contact::select(
            'fournisseurs.id',
            'fournisseurs.sites_id',
            'fournisseurs.nom',
            'fournisseurs.categorisation',
            'fournisseurs.nomGerant',
            'fournisseurs.domaine',
            'fournisseurs.statutJuridique',
            'fournisseurs.users_id',
            'contacts.adresse',
            'contacts.telephone'
        )
            ->join('fournisseurs', 'fournisseurs.id', 'contacts.id_table')
            ->where('contacts.nomTable', 'fournisseurs')
            ->where('sites_id', $id)
            ->where('categorisation', 'agrobusiness')
            ->get();

        $nb_jeune = $children->where('age', '>', 17)->count();
        $nb_enfant  = $children->where('age', '<=', 17)->count();

        $nb_homme = $children->where('genre', 'm')->count();
        $nb_femme = $children->where('genre', 'f')->count();

        return view('mining_zone.statistic_zone', compact('site', 'children', 'nb_enfant', 'nb_jeune', 'nb_homme', 'nb_femme', 'fournisseurs', 'agrobusinesses', 'agricoles', 'mines'));
    }
}
