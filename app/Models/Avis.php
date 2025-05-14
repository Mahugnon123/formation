<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    // Indiquer les champs qui peuvent être assignés en masse
    protected $fillable = [
        'message',  // Contenu de l'avis
        'user_id',  // Identifiant de l'utilisateur qui a soumis l'avis
    ];

    // Définir une relation avec le modèle User (un avis appartient à un utilisateur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
