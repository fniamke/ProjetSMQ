<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMoyen extends Model
{
    use HasFactory;
    protected $table='typemoyen';
    protected $primaryKey = 'IdTypeMoyen';
}
