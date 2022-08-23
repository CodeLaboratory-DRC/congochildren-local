<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Famille extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'enfant_id',
        'nom_pere',
        'nom_mere',
        'instruction_pere',
        'instruction_mere',
        'matrimonial',
        'nb_enfant',
        'nb_homme',
        'nb_femme',
        'activite_princ',
        'activite_sec',
        'revenu_jour',
        'nb_enfant_mine',
        'user_id',
    ];

    public static function countByChild($family)
    {

        return DB::table('familles')->where('enfant_id', $family)->count();
    }

    public static function count()
    {
        return (DB::table('familles')->select('familles.nom_mere')
            ->join('enfants', 'familles.enfant_id', 'enfants.id')
            ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
            ->where('enfants.is_deleted', false)
            ->groupBy('familles.nom_mere')
            ->get())
            ->count();
    }

    public static function countType($province)
    {
        return (DB::table('familles')->select('familles.nom_mere')
            ->join('enfants', 'familles.enfant_id', 'enfants.id')
            ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
            ->join('sites', 'sites.id', 'enfants.site_id')
            ->where('enfants.is_deleted', false)
            ->where('enfants.age', '<=', 17)
            ->where('scolarites.etude', false)
            ->where('sites.province', $province)
            ->groupBy('enfants.nom', 'enfants.age', 'enfants.rang_famille')
            ->get())->unique('nom_mere')->count();
    }


    public static function countLocal($province)
    {
        return (DB::table('familles')->select('familles.nom_mere')
            ->join('enfants', 'familles.enfant_id', 'enfants.id')
            ->join('scolarites', 'enfants.id', 'scolarites.enfant_id')
            ->join('sites', 'sites.id', 'enfants.site_id')
            ->where('sites.province', $province)
            ->where('enfants.is_deleted', false)
            ->groupBy('familles.nom_mere')
            ->get())
            ->count();
    }

    public static function countChildren($name)
    {
        return Famille::join('enfants', 'familles.enfant_id', 'enfants.id')
            ->where('nom_mere', $name)
            ->where('enfants.is_deleted', false)
            ->orWhere('nom_pere', $name)
            ->count();
    }

    public static function findBy($column, $value)
    {
        return Famille::select(
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
            'familles.id',
            'familles.enfant_id',
            'familles.user_id',
            'sites.nom as nomSite'

        )->join('enfants', 'enfants.id', 'familles.enfant_id')
            ->join('sites', 'sites.id', 'enfants.site_id')
            ->where($column, $value)
            ->first();
    }
}
