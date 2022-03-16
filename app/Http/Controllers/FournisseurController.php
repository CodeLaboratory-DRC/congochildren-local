<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Fournisseur;
use App\Models\Localisation;
use Illuminate\Http\Request;
use App\Exports\FournisseurExport;
use App\Exports\SecteurPriveExport;
use Maatwebsite\Excel\Facades\Excel;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
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
            ->where('fournisseurs.categorisation', $type)
            ->where('fournisseurs.is_deleted', '=', false)
            ->orderBy('fournisseurs.nom')
			->paginate(25);

        return view('fournisseurs.fournisseur_list', compact('fournisseurs', 'type'));
    }

    public function export($type)
    {
        if ($type == 'fournisseur') {
            return Excel::download(new FournisseurExport, 'entreprises fournisseurs de materiaux.xlsx');
        } else {
            return Excel::download(new SecteurPriveExport, 'structures du secteur privé opérationnelles dans l\'agrobusiness.xlsx');
        }
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fournisseur = Fournisseur::join('contacts', 'fournisseurs.id', 'contacts.id_table')
            ->where('fournisseurs.id', $id)
            ->first();
        return view('fournisseurs.update', compact('fournisseur','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'statutJuridique' => 'required',
            'nomGerant' => 'required',
            'domaine' => 'required',
            'telephone' => 'required',
            'adresse' => 'required',
        ]);

        $fournisseur = Fournisseur::find($id);
        if ($fournisseur) {

            $four = $fournisseur->update([
                'nom' => $request->nom,
                'statutJuridique' => $request->statutJuridique,
                'nomGerant' => $request->nomGerant,
                'domaine' => $request->domaine,
            ]);

            Contact::where('contacts.nomTable', 'fournisseurs')
                ->where('id_table', $id)
                ->update([
                    'telephone' => $request->telephone,
                    'adresse' => $request->adresse,
                ]);

            if ($four) {
                return redirect()->route('fournisseur.list', $fournisseur->categorisation)->withSuccess('Information mis a jour avec succès');
            }
            return redirect()->back()->withInput()->withError('une erreur s\'est produite');
        }
        return redirect()->back()->withInput()->withError('donnee non existante');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy($fournisseur)
    {
        $fournisseur = Fournisseur::find($fournisseur);
        $fournisseur->is_deleted = true;
        $fournisseur->save();

        return redirect()->back()->with('success', 'Envoyer a la corbeille avec succès');
    }

    public function restore($fournisseur)
    {
        $fournisseur = Fournisseur::find($fournisseur);
        $type = $fournisseur->categorisation;
        $fournisseur->is_deleted = false;
        $fournisseur->save();

        return redirect()->route('fournisseur.bin', $type)->with('success', 'entite restauré avec succès');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bin($type)
    {
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
            ->where('fournisseurs.categorisation', $type)
            ->where('fournisseurs.is_deleted', '=', true)
            ->get();


        return view('fournisseurs.bin', compact('fournisseurs', 'type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroyDef($fournisseur)
    {
        $fournisseur = Fournisseur::find($fournisseur);
        $type = $fournisseur->categorisation;
        Contact::where('id_table', $fournisseur->id)->where('contacts.nomTable', 'fournisseurs')->delete();
        Localisation::where('id_table', $fournisseur->id)->where('localisations.nomTable', 'fournisseurs')->delete();
        $fournisseur->delete();

        return redirect()->route('fournisseur.bin', $type)->withSuccess('entité supprimé avec succès');
    }
}
