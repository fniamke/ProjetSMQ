<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouchard extends Model
{
    use HasFactory;
    protected $table='mouchard';
    protected $primaryKey = 'NumId';

    protected $fillable =
    [
        'DateEvmt','NomEmploye', 'TypeAction', 'Action', 'ValAncienne', 'ValNouveau', 'Poste'
    ];
}
