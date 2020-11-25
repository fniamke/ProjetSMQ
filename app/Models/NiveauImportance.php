<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauImportance extends Model
{
    use HasFactory;
    protected $table='niveauimportance';
    protected $primaryKey = 'IdNivImportance';
}
