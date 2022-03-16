<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Agent;
use App\Models\Enfant;
use App\Models\Contact;
use App\Exports\ChildExport;
use App\Exports\ChildSiteExport;
use App\Models\Enquete;
use App\Models\Famille;
use App\Models\Localisation;
use App\Models\Scolarite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class ChildrenController extends Controller
{
    public function getChild($id)
    {
        return Enfant::select(
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
            'enfants.site_id',
            // 'enfants.image',
            'enfants.user_id',
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
            'sites.nom as nomSite'
        )->join('familles', 'enfants.id', 'familles.enfant_id')
            ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
            ->join('enquetes', 'enfants.id', 'enquetes.enfant_id')
            ->join('sites', 'sites.id', 'enfants.site_id')
            ->where('enfants.id', $id)
            ->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            ->where('age', '<', 18)
            ->where('is_deleted', false)
            ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
            ->orderBy('enfants.nom')
			->paginate(50);
            
        return view('children.children_list', compact('children'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $child = $this->getChild($id);

        if ($child !== null) {
            $enqueteur = User::find($child->users_id);
            $site = Site::where('id', $child->sites_id)->first();

            return view('children.fiche', compact('child', 'enqueteur', 'site', 'id'));
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
        $child = $this->getChild($id);

        return view('children.update', compact('child', 'id'));
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

        $child = Enfant::find($id);
        if ($child) {

            $child = $child->update($request->except('_token', 'user_id'));

            if ($child) {
                // update family
                return redirect()->route('family.edit', $id)->with('success', 'Enfant modifié avec succès');
            }
            return redirect()->back()->withInput()->withError('une erreur s\'est produite');
        }
        return redirect()->back()->withInput()->withError('Enfant non existant');
    }

    public function export()
    {
        return Excel::download(new ChildExport, 'enfants.xlsx');
    }
    
    public function exportBySite($site_id)
    {
        $site = Site::findOrfail($site_id);
        return Excel::download(new ChildSiteExport($site_id), 'enfants-site-'.$site->nom.'.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agricole  $agricole
     * @return \Illuminate\Http\Response
     */
    public function destroy($enfant)
    {
        $enfant = Enfant::find($enfant);
        $enfant->is_deleted = true;
        $enfant->save();

        return redirect()->route('children.list')->with('success', 'Enfant envoyer a la corbeille avec succès');
    }

    public function restore($enfant)
    {
        $enfant = Enfant::find($enfant);
        $enfant->is_deleted = false;
        $enfant->save();

        return redirect()->route('children.bin')->with('success', 'Enfant restauré avec succès');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bin()
    {
        $children = Enfant::where('age', '<', 18)
            ->where('is_deleted', true)
            ->get();
        return view('children.bin', compact('children'));
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

        return redirect()->route('children.bin')->withSuccess('enfant supprimé avec succès');
    }
}
