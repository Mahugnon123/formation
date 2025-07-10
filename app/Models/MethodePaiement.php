<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodePaiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'public_key',
        'secret_key',
        'is_active',
        'paiement_id'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }
}