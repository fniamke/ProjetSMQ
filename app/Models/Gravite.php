<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gravite extends Model
{
    use HasFactory;
    protected $table='gravite';
    protected $primaryKey = 'IdGravite';
}
