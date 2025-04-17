<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
        'chapitre' => 'array'
    ];
    public function question(){
        return $this->hasMany(Question::class);
    }
    public function user(){
        return $this->belongsToMany(Question::class);
    }
    public function certification(){
        return $this->hasOne(Certification::class);
    }
    public function test(){
        return $this->hasOne(Test::class);
    }
    public function resume(){
        return $this->hasMany(Resume::class);
    }
    public function fichier(){
        return $this->morphMany(Resume::class);
    }

}
