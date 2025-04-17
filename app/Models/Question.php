<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'questionReponse',
        'description',
        'titre',
        'userTest_id',
        'user_id',
    ];

   
    public function user(){
        return $this->belongsTo(Question::class);
    }
}
