<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Miniere extends Model
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
        'autreDomaines',
        'users_id',
        'is_deleted',
    ];

    public static function count()
    {
        return DB::table('minieres')->where('minieres.is_deleted', '=', false)->count();
    }

    public static function countLocal($province)
    {
        return DB::table('minieres')
            ->join('sites', 'sites.id', 'minieres.sites_id')
            ->where('sites.province', $province)
            ->where('minieres.is_deleted', '=', false)
            ->count();
    }
}
