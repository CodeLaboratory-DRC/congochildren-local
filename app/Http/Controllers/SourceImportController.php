<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Source;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelReader;

class SourceImportController extends Controller
{
    public function import(Request $request)
    {
        $this->validate($request, [
            'fichier' => 'bail|required|file|mimes:xlsx'
        ]);

        // 2. On déplace le fichier uploadé vers le dossier "public" pour le lire
        $fichier = $request->fichier->move(public_path(), $request->fichier->hashName());

        // 3. $reader : L'instance Spatie\SimpleExcel\SimpleExcelReader
        $reader = SimpleExcelReader::create($fichier);

        // On récupère le contenu (les lignes) du fichier
        $rows = $reader->getRows();

        // $rows est une Illuminate\Support\LazyCollection

        // 4. On insère toutes les lignes dans la base de données
        try {
            $status = Source::insert($rows->toArray());
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->withErrors('Le format des fichiers n\'est pas valide');
        }

        // Si toutes les lignes sont insérées
        if ($status) {

            // 5. On supprime le fichier uploadé
            $reader->close(); // On ferme le $reader
            unlink($fichier);

            // 6. Retour vers le formulaire avec un message $msg
            return back()->withMsg("Importation réussie !");
        } else {
            abort(500);
        }
    }

    public function updateData()
    {
        $datas = [];
        $source = Source::all();
        foreach ($source as $value) {
            $enfant = Enfant::where('nom', $value->name)->first();
            if ($enfant && $enfant->nom) {
                $value->enfant_id = $enfant->id;
                $value->save();
            }
        }

        return count($source);
    }

    public function showList()
    {
        $source = Source::all()->count();
        $parts = round($source / 100);
        // dd($parts);
        return view('source.show', compact('parts'));
    }
}
