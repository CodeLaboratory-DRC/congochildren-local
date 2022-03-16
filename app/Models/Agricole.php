<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agricole extends Model
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
        'serviceAgrement',
        'nomGerant',
        'domaine',
        'capaciteProduction',
        'users_id',
        'equipement',
        'transformation',
        'is_deleted',
    ];

    public static function count()
    {
        return DB::table('agricoles')->where('agricoles.is_deleted', '=', false)->count();
    }

    public static function countLocal($province)
    {
        return DB::table('agricoles')
        ->join('sites', 'sites.id', 'agricoles.sites_id')
        ->where('sites.province', $province)
            ->where('agricoles.is_deleted', '=', false)
            ->count();
    }
}
