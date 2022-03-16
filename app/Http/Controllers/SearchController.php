<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Agricole;
use App\Models\AgroBusiness;
use App\Models\Communaute;
use App\Models\Enfant;
use App\Models\Famille;
use App\Models\Miniere;
use App\Models\Site;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (null !== $request->input('query') && null !== $request->input('type')) {

            $results = $this->filterSearch( $request->input('query'), $request->input('type'));
            return view ('search.search', compact('results'));

        }
        else {
            return view ('search.search');
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $results = Enfant::query()
            ->where('nom', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view ('search.barSearch', compact('results'));
    }

    public function filterSearch($search, $type)
    {
        if ($type == 'children') {
            return Enfant::query()
                ->where('nom', 'LIKE', "%{$search}%")
                ->paginate(10);
        } 
        elseif ($type == 'agricole') {
            return Agricole::query()
                ->where('nom', 'LIKE', "%{$search}%")
                ->orWhere('nomGerant', 'LIKE', "%{$search}%")
                ->orWhere('domaine', 'LIKE', "%{$search}%")
                ->orWhere('categorisation', 'LIKE', "%{$search}%")
                ->orWhere('serviceAgrement', 'LIKE', "%{$search}%")
                ->paginate(10);
        }
        elseif ($type == 'miniere') {
            return Miniere::query()
                ->where('nom', 'LIKE', "%{$search}%")
                ->orWhere('nomGerant', 'LIKE', "%{$search}%")
                ->orWhere('domaine', 'LIKE', "%{$search}%")
                ->orWhere('categorisation', 'LIKE', "%{$search}%")
                ->orWhere('serviceAgrement', 'LIKE', "%{$search}%")
                ->orWhere('autreDomaines', 'LIKE', "%{$search}%")
                ->paginate(10);
        }
        elseif ($type == 'site') {
            return Site::query()
                ->where('nom', 'LIKE', "%{$search}%")
                ->orWhere('province', 'LIKE', "%{$search}%")
                ->orWhere('territoire', 'LIKE', "%{$search}%")
                ->orWhere('localite', 'LIKE', "%{$search}%")
                ->orWhere('responsable', 'LIKE', "%{$search}%")
                ->paginate(10);
        }
        elseif ($type == 'parent') {
            return Famille::query()
            ->where('nom_pere', 'LIKE', "%{$search}%")
            ->orWhere('nom_mere', 'LIKE', "%{$search}%")
            ->orWhere('matrimonial', 'LIKE', "%{$search}%")
            ->orWhere('activite_princ', 'LIKE', "%{$search}%")
            ->orWhere('revenu_jour', 'LIKE', "%{$search}%")
            ->paginate(10);
        }
        elseif ($type == 'agent') {
            return Agent::query()
                ->where('nom', 'LIKE', "%{$search}%")
                ->orWhere('activite', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->paginate(10);
        }
        else{
            return array();
        }
    }
}
