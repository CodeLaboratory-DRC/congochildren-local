<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeune extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'enfant_id',
        'etat_civil',
        'coinjoint',
        'nb_enfant',
        'nb_garcon',
        'nb_fille',
        'nb_scolarise',
    ];
}
