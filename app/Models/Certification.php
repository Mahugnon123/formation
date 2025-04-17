<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certification extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'dateFinDeFormation',
        'appreciation',
        'user_id',
        'prix',
   
    ];
    public function formation(){
        return $this->belongsTo(Formation::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
