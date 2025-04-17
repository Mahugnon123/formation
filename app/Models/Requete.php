<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requete extends Model
{
    use  HasFactory;
    protected $fillable = [
        'nom',
        'description',
        'user_id',
        'slug',
        'formation_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function fichier(){
        return $this->morphMany(Fichier::class);
    }
}
