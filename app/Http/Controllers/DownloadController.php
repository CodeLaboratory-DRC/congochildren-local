<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Site;
use App\Models\Enfant;
use App\Models\Contact;
use App\Models\Famille;
use App\Models\Miniere;
use App\Models\Localite;
use App\Models\Source;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class DownloadController extends Controller
{
    public function cardPrint($id)
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

        return $this->savePDF('print.carte', $data, 'carteQR', 'a4');
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
        return $path;
    }

    public function exportCardByLocalite($localite, $part = 1)
    {
        $begin = ($part - 1) * 100;

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
            ->where('sites.localite', $localite)
            ->groupBy('enfants.nom', 'enfants.age', 'enfants.genre', 'enfants.rang_famille')
            ->orderBy('enfants.id', 'asc')
            ->skip($begin)->take(100)
            ->get();

        if ($children->isNotEmpty()) {
            // generate children card
            $card = [];
            foreach ($children as $child) {
                array_push($card, $this->cardPrint($child->id));
            }
            // generate and download zip folder contain all card
            return $this->archive($card);
        }
    }

    public function archive($card)
    {
        $zip = new ZipArchive;
        $fileName = 'children_card_' . date('d-m-Y-his') . '.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            foreach ($card as $c) {
                $zip->addFile($c, basename($c));
            }
            $files = File::files(public_path('/export/card'));

            // foreach ($files as $key => $value) {
            //     $relativeName = basename($value);
            //     $zip->addFile($value, $relativeName);
            // }
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




    public function exportCardBySource($part = 1)
    {
        $begin = ($part - 1) * 100;
        $childrens = [];
        $sources = Source::select('enfant_id')
            ->orderBy('enfant_id', 'asc')
            ->skip($begin)->take(100)
            ->get();


        foreach ($sources as $value) {
            if ($value->enfant_id) {
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
                    ->where('enfants.id', $value->enfant_id)
                    ->orderBy('enfants.id', 'asc')
                    ->get();

                if ($children->isNotEmpty()) {
                    array_push($childrens, $children);
                }
            }
        }

        if (!empty($childrens)) {
            // generate children card
            $card = [];
            foreach ($childrens as $child) {
                array_push($card, $this->cardPrint($child[0]->id));
            }
            // generate and download zip folder contain all card
            return $this->archive($card);
        } else {
            return 'aucune donnees a exporter';
        }
    }
}
