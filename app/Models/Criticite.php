<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criticite extends Model
{
    use HasFactory;
    protected $table='criticite';
    protected $primaryKey = 'IdCriticite';
}
