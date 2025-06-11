<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Formation extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_slug',
        'titre',
        'type',
        'image_url',
        'description',
        'payante_ou_non',
        'prix_formation',
        'prix_certification',
        'contenu',
        'competence',
        'a_propos',
        'chapitre',
        'duree',
        'besoin',
        'editordata',
        'slug',
        'status',
        'category_id'
    ];

    protected $casts = [
        'chapitre' => 'array',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function certification()
    {
        return $this->hasOne(Certification::class);
    }

    public function resume()
    {
        return $this->hasMany(Resume::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function formateur()
    {
        return $this->belongsTo(User::class, 'user_slug', 'slug');
    }

    public function requetes()
    {
        return $this->hasMany(Requete::class, 'formation_id');
    }

    public function vues()
    {
        return $this->hasMany(FormationView::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}