<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Frere extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'famille_id',
        'nom',
        'age',
        'sexe',
        'instruction',
    ];

    public static function getByFamilly($family)
    {
       
        return DB::table('freres')->where('famille_id', $family)->get();
    }
}
