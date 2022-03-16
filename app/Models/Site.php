<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'province',
        'territoire',
        'localite',
        'initial',
        'responsable',
        'phone',
        'localites_id',
        'users_id'
    ];

    public static function localiteName($site_id)
    {
       
        return (DB::table('sites')->where('id', $site_id)->get())->localite;
    }

    public static function countByLocalite($localite)
    {
       
        return DB::table('sites')->where('localite', $localite)->count();
    }
}
