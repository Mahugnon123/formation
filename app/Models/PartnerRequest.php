<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerRequest extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'nom_complet',
        'prenom',
        'email',
        'telephone',
        'domaines_expertise',
        'linkedin',
        'presentation',
        'motivation',
        'cv_path',
        'lettre_motivation_path',
        'piece_identite_path',
        'certificats_paths',
        'photo_profil_path',
    ];

    /**
     * Les attributs qui doivent être castés vers des types natifs.
     *
     * @var array
     */
    protected $casts = [
        'certificats_paths' => 'json',
    ];
}