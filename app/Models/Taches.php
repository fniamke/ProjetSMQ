<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taches extends Model
{
    use HasFactory;
    protected $table='taches';
    protected $primaryKey = 'IdTaches';
}
