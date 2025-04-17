<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'titre',
        'resumeChapitre',
        'user_id',
        'formation_id'
    ];

    protected $casts = [
        'resumeChapitre' => 'array',
    ];
}
