<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodePaiement extends Model
{

    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'nom',
        'paiement_id',
    ];
    public function paiement(){
        return $this->hasMany(Paiement::class);
    }

}
