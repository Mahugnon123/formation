<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Certification extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'dateFinFormation',
        'appreciation',
        'user_id',
        'formation_id',
   
    ];
    public function formation(){
        return $this->belongsTo(Formation::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
