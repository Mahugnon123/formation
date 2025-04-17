<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'nom',
        'contenus',
    ];

    public function formation(){
        return $this->belongsTo(Formation::class);
    }
    public function fichier(){
        return $this->morphMany(Fichier::class);
    }}
