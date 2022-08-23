<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Site;
use App\Models\Enfant;
use App\Models\Contact;
use App\Models\Famille;
use App\Models\Miniere;
use App\Models\Localite;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PrintController extends Controller
{
    public function cardPrint($id, $save = false)
    {
        $data = Enfant::select(
            'enfants.id',
            'enfants.nom',
            'enfants.age',
            'enfants.genre',
            'enfants.adresse',
            'enfants.contact_princ',
            'enfants.contact_sec',
            'sites.nom as nomSite',
            'sites.province',
            'familles.nom_pere',
            'familles.nom_mere',
        )->join('sites', 'sites.id', 'enfants.site_id')
            ->join('familles', 'enfants.id', 'familles.enfant_id')
            ->where('enfants.id', $id)
            ->first();

        // generate qrcode 
        $this->generateQr($data);

        if ($save) {
            return $this->savePDF('print.carte', $data, 'carteQR', 'a4');
        }
        $name = str_replace(' ', '-', $data->nom) . '-01142' . $data->id . '-card';
        return $this->downloadPDF('print.carte', $data, $name, 'a4');
    }

    public function enfantYoungPrint()
    {
        $child = Enfant::where('is_deleted', '=', false)->get();

        return $this->downloadPDF('print.enfantsYoung', $child, 'Liste des enfants et des jeunes');
    }


    public function childrenPrint()
    {
        $children = Enfant::where('age', '<', 19)->where('is_deleted', '=', false)->get();
        return $this->downloadPDF('print.childrens', $children, 'Liste des enfants');
    }

    public function youngPrint()
    {
        $youngers = Enfant::where('age', '>', 18)->where('is_deleted', '=', false)->get();
        return $this->downloadPDF('print.youngs', $youngers, 'Liste des jeunes');
    }

    public function minePrint()
    {
        $mines = Miniere::where('is_deleted', '=', false)->get();
        return $this->downloadPDF('print.mine', $mines, 'Liste des coopératives minières');
    }

    public function agroPrint()
    {
        $agricoles = Contact::select(
            'agricoles.id',
            'agricoles.sites_id',
            'agricoles.nom',
            'agricoles.categorisation',
            'agricoles.serviceAgrement',
            'agricoles.nomGerant',
            'agricoles.domaine',
            'agricoles.capaciteProduction',
            'agricoles.users_id',
            'agricoles.is_deleted',
            'contacts.adresse',
            'contacts.telephone'
        )
            ->join('agricoles', 'agricoles.id', 'contacts.id_table')
            ->where('contacts.nomTable', 'agricoles')
            ->where('agricoles.is_deleted', '=', false)
            ->get();
        return $this->downloadPDF('print.agricole', $agricoles, 'Liste des coopératives agricoles');
    }

    public function localitePrint()
    {
        $data = Localite::all();
        return $this->downloadPDF('print.localites', $data, 'Liste des localités');
    }

    public function sitePrint($localite)
    {
        $data = Site::where('localites_id', $localite)->get();
        $data->localite = Localite::findOrFail($localite);

        return $this->downloadPDF('print.sites', $data, 'Liste des sites');
    }

    public function menagePrint()
    {
        $data = Famille::all();
        return $this->downloadPDF('print.family', $data, 'Liste des menages');
    }

    public function fournisseurPrint($type)
    {
        $data = Contact::select(
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
            ->where('is_deleted', '=', false)
            ->get();

        if ($type == 'fournisseur') {
            return $this->downloadPDF('print.fournisseur', $data, 'Liste des entreprises locales fournisseurs des materiaux de construction');
        } else {
            return $this->downloadPDF('print.secteurPrive', $data, 'Liste des structures du secteur prive operationnelles dans l’agrobusiness');
        }
    }

    public function downloadPDF($view, $data = null, $name, $paper = 'a4', $orientation = 'landscape')
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView($view, compact('data'));
        $pdf->setPaper($paper, $orientation);

        return $pdf->download(str_replace(' ', '-', $name) . '-' . date('Y-m-d-his') . '.pdf');
    }

    public function savePDF($view, $data = null, $name, $paper = 'a4', $orientation = 'landscape')
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView($view, compact('data'));
        $pdf->setPaper($paper, $orientation);

        $path = public_path() . '/export/card/' . str_replace(' ', '-', $data->nom) . '-01142' . $data->id . '-card.pdf';
        if (!file_exists($path)) {
            $pdf->save($path);
        }
    }

    public function exportAllCard()
    {
        $children = Enfant::select(
            'enfants.id',
            'enfants.nom',
            'enfants.age',
            'enfants.genre',
            'enfants.adresse',
            'enfants.contact_princ',
            'enfants.contact_sec',
            'sites.nom as nomSite',
            'sites.province',
            'familles.nom_pere',
            'familles.nom_mere',
        )->join('sites', 'sites.id', 'enfants.site_id')
            ->join('familles', 'enfants.id', 'familles.enfant_id')
            ->where('enfants.is_deleted', false)
            ->groupBy('enfants.nom', 'enfants.age', 'enfants.genre', 'enfants.rang_famille')
            ->orderBy('enfants.id', 'asc')
            ->get();

        if ($children->isNotEmpty()) {
            // generate children card
            $i = 0;
            foreach ($children as $child) {
                if ($i < 10) {
                    $i++;
                    $this->cardPrint($child->id, true);
                } else {
                    return $this->archive();
                }
            }
            // generate and download zip folder contain all card
            return $this->archive();
        }
    }

    public function archive()
    {
        $zip = new ZipArchive;
        $fileName = 'children_card_' . date('d-m-Y-his') . '.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            $files = File::files(public_path('/export/card'));
            foreach ($files as $key => $value) {
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();
        }
        return response()->download(public_path($fileName));
    }

    public function generateQr($child)
    {
        $path = public_path() . '/qrcodes/qrcode-' . $child->id . '.svg';
        if (!file_exists($path)) {
            QrCode::size(200)->generate(URL::to('/') . '/api/identify/' . $child->id, $path);
        }
        return true;
    }
}
