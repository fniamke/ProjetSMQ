<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicateurs extends Model
{
    use HasFactory;
    protected $table='indicateurs';
    //protected $primaryKey = 'id';

    protected $fillable =
    [
        'IdIndicateur','IdProcessus','IdSousProcessus', 'LibIndicateur', 'Periodicite', 'DateDebutPeriode', 'DebutPeriode', 'FinPeriode', 'Objectif', 'Resultat', 'Etat',
        'Observation', 'NumLigne', 'Archiver', 'IdSociete'
    ];

}
