<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Agent;
use App\Models\Enfant;
use App\Models\Enquete;
use App\Models\Famille;
use App\Models\Scolarite;
use App\Exports\YoungExport;
use App\Models\Jeune;
use App\Models\Localisation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class YoungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $youngers = Enfant::select('enfants.id',
            'enfants.nom',
            'enfants.age',
            'enfants.genre',
            'enfants.adresse',
            'enfants.parent_vie',
            'enfants.deplace',
            'enfants.habitation',
            'enfants.rang_famille',
            'enfants.user_id',
            'enfants.site_id')->where('age', '>', 17)
            ->join('enquetes', 'enfants.id', 'enquetes.enfant_id')
            ->join('familles', 'enfants.id', 'familles.enfant_id')
            ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
            ->where('is_deleted', false)
            ->orderBy('enfants.nom')
			->paginate(50);
			
        return view('young.young_list', compact('youngers'));
    }

    public function getOne($id)
    {
        return Enfant::select(
            'familles.nom_pere',
            'familles.nom_mere',
            'familles.instruction_pere',
            'familles.instruction_mere',

            'enfants.id',
            'enfants.nom',
            'enfants.age',
            'enfants.genre',
            'enfants.adresse',
            'enfants.parent_vie',
            'enfants.deplace',
            'enfants.habitation',
            'enfants.rang_famille',
            'enfants.contact_princ',
            'enfants.contact_sec',
            'enfants.user_id',
            'enfants.site_id',

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
            'jeunes.nb_scolarise',

            'sites.nom as nomSite'
        )->join('familles', 'enfants.id', 'familles.enfant_id')
            ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
            ->leftJoin('jeunes', 'enfants.id', 'jeunes.enfant_id')
            ->join('enquetes', 'enfants.id', 'enquetes.enfant_id')
            ->join('sites', 'sites.id', 'enfants.site_id')
            ->where('is_deleted', false)
            ->where('enfants.id', $id)
            ->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $younger = $this->getOne($id);

        if ($younger !== null) {
            $site = Site::where('id', $younger->sites_id)->first();
            $jeune = Jeune::where('enfant_id', $id)->first();

            $enqueteur = User::find($younger->users_id);

            return view('young.fiche', compact('younger', 'enqueteur', 'site', 'id', 'jeune'));
        }
        return redirect(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enfant  $young
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $young = $this->getOne($id);

        return view('young.update', compact('young', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Miniere  $miniere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'site_id' => 'required',
            'nom' => 'required',
            'age' => 'required',
            'genre' => 'required',
            'adresse' => 'required',
            'parent_vie' => 'required',
            'deplace' => 'required',
            'habitation' => 'required',
            'rang_famille' => 'required',
        ]);

        $young = Enfant::find($id);
        if ($young) {

            $young = $young->update($request->except('_token', 'user_id'));

            if ($young) {
                // update family
                return redirect()->route('family.edit', $id)->with('success', 'jeune modifié avec succès');
            }
            return redirect()->back()->withInput()->withError('une erreur s\'est produite');
        }
        return redirect()->back()->withInput()->withError('jeune non existant');
    }

    public function export()
    {
        return Excel::download(new YoungExport, 'jeunes.xlsx');
    }

    public function destroy($enfant)
    {
        $enfant = Enfant::find($enfant);
        $enfant->is_deleted = true;
        $enfant->save();

        return redirect()->route('young.list')->with('success', 'Jeune envoyer a la corbeille avec succès');
    }

    public function restore($enfant)
    {
        $enfant = Enfant::find($enfant);
        $enfant->is_deleted = false;
        $enfant->save();

        return redirect()->route('young.bin')->with('success', 'Jeune restauré avec succès');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bin()
    {
        $youngers = Enfant::where('age', '<', 18)
            ->where('is_deleted', true)
            ->get();
        return view('young.bin', compact('youngers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agricole  $agricole
     * @return \Illuminate\Http\Response
     */
    public function destroyDef($enfant)
    {
        $enfant = Enfant::find($enfant);
        Localisation::where('id_table', $enfant->id)->where('localisations.nomTable', 'enfants')->delete();
        Famille::where('enfant_id', $enfant->id)->delete();
        Scolarite::where('enfant_id', $enfant->id)->delete();
        Enquete::where('enfant_id', $enfant->id)->delete();
        $enfant->delete();

        return redirect()->route('young.bin')->withSuccess('Jeune supprimé avec succès');
    }
}
