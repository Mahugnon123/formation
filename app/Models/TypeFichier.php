<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeFichier extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'nom',
    ];
    public function fichier(){
        return $this->hasMany(Fichier::class);
    }
}
