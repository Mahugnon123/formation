<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'nom',
        'etat',
        'statutable_id',
        'statutable_type',

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
    public function rappel(){
        return $this->morphTo(Rappel::class);
    }
   
}
