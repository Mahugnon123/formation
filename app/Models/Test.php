<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'title',
        'type_id',
        'formation_id'
    
    ];
    
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function user(){
        return $this->belongsToMany(Type::class);
    }
}
