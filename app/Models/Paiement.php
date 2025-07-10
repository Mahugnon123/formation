<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use  HasFactory;

    use HasFactory;
        protected $fillable = [
        'user_id',
        'formation_id',
        'transaction_id',
        'montant',
        'description'
    

    ];
    public function methodesPaiement()
    {
        return $this->hasMany(MethodePaiement::class);
    }
    }