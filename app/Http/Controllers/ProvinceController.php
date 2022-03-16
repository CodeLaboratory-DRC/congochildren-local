<?php

namespace App\Http\Controllers;

use App\Models\Localite;
use App\Models\Site;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{

    public function index($name)
    {

        $localites = Localite::where('province', $name)->get();

        $sites = Site::select('sites.id','sites.initial','sites.nom','sites.phone','sites.responsable','localites.territoire','localites.province')
                        ->join('localites', 'localites.id', 'sites.localites_id')
                        ->where('localites.province',$name)
                        ->get();

        return view('province_detail', compact('name','localites','sites'));

    }
}
