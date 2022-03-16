<?php

namespace App\Http\Controllers;

use App\Models\Scolarite;
use App\Models\Enfant;
use Illuminate\Http\Request;

class ScolariteController extends Controller
{
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
    public function edit($enfant_id)
    {
        $scolarite = Scolarite::where('scolarites.enfant_id', $enfant_id)->first();
        $enfant = Enfant::find($enfant_id);

        return view('scolarite.update', compact('scolarite', 'enfant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scolarite  $scolarite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'etude' => 'required',
        ]);

        $scolarite = Scolarite::find($id);
        $enfant_id = $scolarite->enfant_id;

        if ($scolarite) {

            $scolarite = $scolarite->update($request->all());

            if ($scolarite) {
                // TODO: update enquete
                return redirect()->route('enquete.edit', $enfant_id)->with('success', 'Scolarité modifié avec succès');
            }
            return redirect()->back()->withInput()->withError('une erreur s\'est produite');
        }
        return redirect()->back()->withInput()->withError('Scolarité non existant');
    }
}
