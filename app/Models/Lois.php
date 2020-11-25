<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lois extends Model
{
    use HasFactory;

	protected $fillable =
    [
        'IdCategoriesLois','LibLois','DatePromulgation'
    ];

    public function attachements()
    {
    	return $this->morphMany(Attachements::classe, 'attachable');
    }
}