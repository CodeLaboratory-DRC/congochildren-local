<?php

namespace App\Http\Controllers;

use App\Models\Enquete;
use App\Models\Enfant;
use Illuminate\Http\Request;

class EnqueteController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquete $enquete
     * @return \Illuminate\Http\Response
     */
    public function edit($enfant_id)
    {
        $enquete = Enquete::where('enquetes.enfant_id', $enfant_id)->first();
        $enfant = Enfant::find($enfant_id);

        return view('enquete.update', compact('enquete', 'enfant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'debut' => 'required',
            'travail_ant' => 'required',
            'ameneur' => 'required',
            'occupation' => 'required|string',
            'motivation' => 'required|string',
            'satisfaction' => 'required',
            'maladie' => 'required',
            'accident' => 'required',
            'soin' => 'required',
            'distance_soin' => 'required|string',
            'distance_mine' => 'required|string',
            'patron' => 'required',
            'abandonner' => 'required',
            'autre_activite' => 'required',
        ]);

        $enquete = Enquete::find($id);
        $enfant = Enfant::find($enquete->enfant_id);

        if ($enquete) {

            $enquete = $enquete->update($request->all());

            if ($enquete) {
                if($enfant->age > 17) {
                    return redirect()->route('young.show', $enfant->id)->with('success', 'Information du jeune modifiée avec succès');
                }
                return redirect()->route('children.show', $enfant->id)->with('success', 'Information de l\'enfant modifiée avec succès');
            }
            return redirect()->back()->withInput()->withError('une erreur s\'est produite');
        }
        return redirect()->back()->withInput()->withError('Enquete non existant');
    }
}
