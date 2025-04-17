<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rappel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'titre',
        'commentaire',
    ];
    
    public function planifier(){
        return $this->belongsTo(Planifier::class);
    }
    public function statut(){
        return $this->morphMany(Statut::class);
    }
}
