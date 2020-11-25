<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $table='messages';
    
    protected $fillable =
    [
        'IdExpediteur','Expediteur','emailExpediteur', 'IdDestinataire', 'Destinataire', 'emailDestinataire', 'message', 'IdSociete', 'IdOrigine', 'statut'
    ];

}
