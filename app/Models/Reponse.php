<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'reponses',
        'reponse_id',
        'commentaires',
    ];

    public function question(){
        return $this->belongsToMany(Question::class);
    }
        
}
