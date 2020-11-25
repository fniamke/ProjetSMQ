<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanActions extends Model
{
    use HasFactory;
    
    protected $table='planActions';
    protected $primaryKey = 'IdPlanaction';
}
