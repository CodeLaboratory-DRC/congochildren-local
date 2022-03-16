<?php

namespace App\Http\Controllers;

use App\Models\Famille;
use App\Models\Enfant;
use Illuminate\Http\Request;
use App\Exports\FamilleExport;
use App\Models\Frere;
use Maatwebsite\Excel\Facades\Excel;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Famille::all();

        return view('family.families', compact('families'));
    }

    public function export()
    {
        return Excel::download(new FamilleExport, 'menages.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function getOne($id)
    {
        return Famille::select(
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
            'familles.id',
            'familles.enfant_id',
            'familles.user_id',
            'sites.nom as nomSite'

        )->join('enfants', 'enfants.id', 'familles.enfant_id')
        ->join('sites', 'sites.id', 'enfants.site_id')
        ->where('familles.id', $id)
        ->first();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $family = $this->getOne($id);

        if ($family != null) {
            $child = Enfant::select('enfants.id','enfants.genre','enfants.age', 'enfants.nom','scolarites.etude','scolarites.niveauEtude')
                ->join('familles', 'enfants.id', 'familles.enfant_id')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->where('familles.nom_pere', $family->nom_pere)
                ->where('familles.nom_mere', $family->nom_mere)
                ->get();

            return view('family.fiche', compact('family', 'id', 'child'));
        }
        return redirect(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $family = Famille::findBy('familles.enfant_id',$id);
        $jeune = Enfant::find($id);
        $freres = Frere::where('famille_id', $family->id)->get();

        return view('family.update', compact('family', 'jeune','freres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nb_enfant' => 'required',
            'nb_homme' => 'required',
            'nb_femme' => 'required',
            'nb_enfant_mine' => 'required',
        ]);

        $family = Famille::find($id);
        $enfant_id = $family->enfant_id;
        if ($family) {

            $family = $family->update($request->all());

            if ($family) {
                // return redirect()->back()->with('success', 'Famille modifié avec succès');
                // TODO: update scolarite
                return redirect()->route('scolarite.edit', $enfant_id)->with('success', 'Famille modifié avec succès');
            }
            return redirect()->back()->withInput()->withError('une erreur s\'est produite');
        }
        return redirect()->back()->withInput()->withError('Famille non existant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Famille  $famille
     * @return \Illuminate\Http\Response
     */
    public function destroy(Famille $famille)
    {
        //
    }
}
