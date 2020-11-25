<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousProcessus extends Model
{
    use HasFactory;
    
    protected $table='sousprocessus';
    protected $primaryKey = 'IdSousProcessus';
}
