<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyseRisques extends Model
{
    use HasFactory;
    protected $table='analyserisques';
    protected $primaryKey = 'IdAnalyserisques';
}
