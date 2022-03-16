<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enquete extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'enfant_id',
        'debut',
        'travail_ant',
        'ameneur',
        'occupation',
        'motivation',
        'satisfaction',
        'maladie',
        'accident',
        'soin',
        'distance_soin',
        'distance_mine',
        'patron',
        'abandonner',
        'autre_activite',
        'is_deleted'
    ];

    public static function statsYear($province = null)
    {
        $years = self::generateArrayOfYears();
        $stats = [];

        foreach ($years as $year) {
            if (null !== $province) {

                $nb = DB::table('enquetes')
                    ->join('enfants', 'enfants.id', 'enquetes.enfant_id')
                    ->join('sites', 'sites.id', 'enfants.sites_id')
                    ->join('localites', 'localites.id', 'sites.localites_id')
                    ->where('enfants.is_deleted', false)
                    ->where('localites.province', $province)
                    ->where('debut', $year)
                    ->count();
            } else {
                $nb = (DB::table('enquetes')
                    ->join('enfants', 'enfants.id', 'enquetes.enfant_id')
                    ->where('enfants.is_deleted', false)
                    ->where('debut', $year)->get())
                    ->count();
            }
            array_push($stats, $nb);
        }

        return $stats;
    }

    protected static function generateArrayOfYears()
    {
        $max = date('Y');
        $min = $max - 9;
        $years = [];

        for ($i = $min; $i <= $max; $i++) {
            array_push($years, $i);
        }
        return $years;
    }
}
