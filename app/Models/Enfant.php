<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enfant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'site_id',
        'nom',
        'age',
        'genre',
        'adresse',
        'parent_vie',
        'deplace',
        'habitation',
        'rang_famille',
        'contact_princ',
        'contact_sec',
        'user_id',
        'is_deleted',
    ];

    public static function count($type = null)
    {
        if ($type == 'enfant') {
            return (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->where('enfants.is_deleted', '=', false)
                ->where('age', '<=', 17)
                ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->get())->count();
        } elseif ($type == 'jeune') {
            return (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->where('enfants.is_deleted', '=', false)
                ->where('age', '>', 17)
                ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->get())->count();
        } else {
            return (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->where('enfants.is_deleted', '=', false)
                ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->get())->count();
        }
    }

    // public static function countType($province)
    // {
    //     return (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
    //         ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
    //         ->join('sites', 'sites.id', 'enfants.site_id')
    //         ->where('enfants.is_deleted', '=', false)
    //         ->where('age', '>', 17)
    //         ->where('scolarites.chargeFrais', 'Soi même')
    //         ->where('sites.province', $province)
    //         ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
    //         ->get())->count();
    // }


    public static function countLocal($type = null, $province)
    {
        if ($type == 'enfant') {
            return (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->join('sites', 'sites.id', 'enfants.site_id')
                ->where('sites.province', $province)
                ->where('enfants.is_deleted', '=', false)
                ->where('age', '<=', 17)
                ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->get())->count();
        } elseif ($type == 'jeune') {
            return (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->join('sites', 'sites.id', 'enfants.site_id')
                ->where('sites.province', $province)
                ->where('enfants.is_deleted', '=', false)
                ->where('age', '>', 17)
                ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->get())->count();
        } else {
            return (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->join('sites', 'sites.id', 'enfants.site_id')
                ->where('sites.province', $province)
                ->where('enfants.is_deleted', '=', false)
                ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->get())->count();
        }
    }

    public static function countByLocalite($localite)
    {
        return (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
            ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
            ->join('sites', 'sites.id', 'enfants.site_id')
            ->where('sites.localite', $localite)
            ->where('enfants.is_deleted', '=', false)
            ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
            ->get())->count();
    }

    public static function countByage($tranche, $province = null)
    {
        if ($tranche == 1) {
            $nb = (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->where('age', '<', 14)
                ->where('enfants.is_deleted', '=', false)
                ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->get())->count();
        } elseif ($tranche == 2) {
            $nb = (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->where('age', '>=', 14)
                ->where('age', '<=', 18)
                ->where('enfants.is_deleted', '=', false)
                ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->get())->count();
        } elseif ($tranche == 3) {
            $nb = (DB::table('enfants')->select('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
                ->where('age', '>', 18)
                ->where('enfants.is_deleted', '=', false)
                ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
                ->get())->count();
        }
        return $nb;
    }

    public static function getInfos($id)
    {
        return (DB::table('enfants')->select('sites.province')
            ->join('sites', 'sites.id', 'enfants.site_id')
            ->where('enfants.id', $id)
            ->where('enfants.is_deleted', '=', false)
            ->first()
        )->province;
    }

    public static function getByFamilly($id)
    {
        return DB::table('enfants')
            ->join('familles', 'familles.enfants_id', 'enfants.id')
            ->where('familles.id', $id)
            ->get();
    }
}
