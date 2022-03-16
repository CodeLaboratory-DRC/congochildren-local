<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\Fournisseur;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SecteurPriveExport implements FromView
{
    public function view(): View
    {
        return view('exports.secteur_prive', [
            'fournisseurs' => Contact::select(
                'fournisseurs.id',
                'fournisseurs.sites_id',
                'fournisseurs.nom',
                'fournisseurs.categorisation',
                'fournisseurs.nomGerant',
                'fournisseurs.domaine',
                'fournisseurs.statutJuridique',
                'fournisseurs.users_id',
                'contacts.adresse',
                'contacts.telephone',
                'contacts.email',
                'contacts.website'
            )
                ->join('fournisseurs', 'fournisseurs.id', 'contacts.id_table')
                ->where('contacts.nomTable', 'fournisseurs')
                ->where('fournisseurs.categorisation', 'agrobusiness')
                ->where('fournisseurs.is_deleted', '=', false)
                ->get()
        ]);
    }
    
}
