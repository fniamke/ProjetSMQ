<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauRelation extends Model
{
    use HasFactory;
    
    protected $table='niveaurelation';
    protected $primaryKey = 'IdNivRelation';
}
