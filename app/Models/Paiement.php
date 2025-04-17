<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'nom',
        'user_id',
        'formation_id',
    ];
    }
