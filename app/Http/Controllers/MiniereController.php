<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Miniere;
use App\Models\Localisation;
use Illuminate\Http\Request;
use App\Exports\MiniereExport;
use Maatwebsite\Excel\Facades\Excel;


class MiniereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mines = Contact::select(
            'minieres.id',
            'minieres.sites_id',
            'minieres.nom',
            'minieres.categorisation',
            'minieres.serviceAgrement',
            'minieres.nomGerant',
            'minieres.domaine',
            'minieres.autreDomaines',
            'minieres.users_id',
            'minieres.is_deleted',
            'contacts.adresse',
            'contacts.telephone',
            'contacts.website',
            'contacts.email'
        )
            ->join('minieres', 'minieres.id', 'contacts.id_table')
            ->where('contacts.nomTable', 'minieres')
            ->where('minieres.is_deleted', '=', false)
            ->orderBy('minieres.nom')
			->paginate(25);

        return view('coop_miniere.miniere', compact('mines'));
    }

    public function export()
    {
        return Excel::download(new MiniereExport, 'coopératives_minieres.xlsx');
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
     * @param  \App\Models\Miniere  $miniere
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mine = Contact::select(
            'minieres.id as miniere_id',
            'minieres.sites_id',
            'minieres.nom',
            'minieres.categorisation',
            'minieres.serviceAgrement',
            'minieres.nomGerant',
            'minieres.domaine',
            'minieres.autreDomaines',
            'minieres.users_id',
            'minieres.is_deleted',
            'contacts.adresse',
            'contacts.telephone',
            'contacts.website',
            'contacts.email'
        )
            ->join('minieres', 'minieres.id', 'contacts.id_table')
            ->where('contacts.nomTable', 'minieres')
            ->where('minieres.id', $id)
            ->where('minieres.is_deleted', '=', false)
            ->first();

        return view('coop_miniere.miniere_detail', compact('mine', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Miniere  $miniere
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mine = Miniere::join('contacts', 'minieres.id', 'contacts.id_table')
            ->where('minieres.id', $id)
            ->first();
        return view('coop_miniere.update', compact('mine', 'id'));
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
            'nom' => 'required',
            'categorisation' => 'required',
            'serviceAgrement' => 'required',
            'nomGerant' => 'required',
            'domaine' => 'required',
            'adresse' => 'required',
            'telephone' => 'required',
        ]);

        $miniere = Miniere::find($id);
        if ($miniere) {

            $four = $miniere->update([
                'nom' => $request->nom,
                'categorisation' => $request->categorisation,
                'serviceAgrement' => $request->serviceAgrement,
                'nomGerant' => $request->nomGerant,
                'domaine' => $request->domaine,
                'autreDomaines' => $request->autreDomaines ?? '',
            ]);

            Contact::where('contacts.nomTable', 'minieres')
                ->where('id_table', $id)
                ->update([
                    'telephone' => $request->telephone,
                    'adresse' => $request->adresse,
                    'email' => $request->email ?? '',
                    'website' => $request->website ?? '',
                ]);

            if ($four) {
                return redirect()->route('mine.list')->withSuccess('Information mis a jour avec succès');
            }
            return redirect()->back()->withInput()->withError('une erreur s\'est produite');
        }
        return redirect()->back()->withInput()->withError('cooperative miniere non existante');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\miniere  $miniere
     * @return \Illuminate\Http\Response
     */
    public function destroy($miniere)
    {
        $miniere = Miniere::find($miniere);
        $miniere->is_deleted = true;
        $miniere->save();

        return redirect()->route('mine.list')->with('success', 'Envoyer a la corbeille avec succès');
    }

    public function restore($miniere)
    {
        $miniere = Miniere::find($miniere);
        $miniere->is_deleted = false;
        $miniere->save();

        return redirect()->route('mine.bin')->with('success', 'cooperative miniere restauré avec succès');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bin()
    {
        $mines = Contact::select(
            'minieres.id',
            'minieres.sites_id',
            'minieres.nom',
            'minieres.categorisation',
            'minieres.serviceAgrement',
            'minieres.nomGerant',
            'minieres.domaine',
            'minieres.autreDomaines',
            'minieres.users_id',
            'minieres.is_deleted',
            'contacts.adresse',
            'contacts.telephone',
            'contacts.website',
            'contacts.email'
        )
            ->join('minieres', 'minieres.id', 'contacts.id_table')
            ->where('contacts.nomTable', 'minieres')
            ->where('minieres.is_deleted', '=', true)
            ->get();


        return view('coop_miniere.bin', compact('mines'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\miniere  $miniere
     * @return \Illuminate\Http\Response
     */
    public function destroyDef($miniere)
    {
        $miniere = Miniere::find($miniere);
        Contact::where('id_table', $miniere->id)->where('contacts.nomTable', 'minieres')->delete();
        Localisation::where('id_table', $miniere->id)->where('localisations.nomTable', 'minieres')->delete();
        $miniere->delete();

        return redirect()->route('mine.bin')->withSuccess('cooperative miniere supprimé avec succès');
    }
}
