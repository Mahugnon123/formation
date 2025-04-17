<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planifier extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'debut',
        'fin',
        'title',
        'formation_id',
        'user_id',
    ];

    public function formation(){
        return $this->hasMany(Formation::class);
    }
    public function rappel(){
        return $this->hasMany(Rappel::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
