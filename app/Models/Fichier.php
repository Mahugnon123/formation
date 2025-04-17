<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'nom',
        'fichier_url',
        'commentaires',
    ];
    
    public function formation(){
        return $this->morphTo(Formation::class);
    }
    public function test(){
        return $this->morphTo(Test::class);
    }
    public function chapitre(){
        return $this->morphTo(Chapitre::class);
    }
    public function requete(){
        return $this->morphTo(Requete::class);
    }
    public function forumReponse(){
        return $this->morphTo(ForumReponse::class);
    }
}
