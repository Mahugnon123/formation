<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'adresseIp',
        'description',
        'userAgent',
        'user_id',
   
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
