<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionReponse extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'statut',
        'question_id',
        'reponse_id',
    ];
}
