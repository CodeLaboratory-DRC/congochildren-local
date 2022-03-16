<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'sites_id',
        'nom',
        'categorisation',
        'statutJuridique',
        'nomGerant',
        'domaine',
        'users_id',
        'is_deleted',
    ];

    public static function countLocal($type, $province)
    {
        return DB::table('fournisseurs')
            ->join('sites', 'sites.id', 'fournisseurs.sites_id')
            ->where('sites.province', $province)
            ->where('fournisseurs.is_deleted', '=', false)
            ->where('fournisseurs.categorisation', $type)
            ->count();
    }
}
