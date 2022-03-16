<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scolarite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'enfant_id',
        'etude',
        'niveauEtude',
        'chargeFrais',
        'travailEtude',
        'horaire',
        'frequentation',
    ];
}
