<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Category extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'nom',
        'slug',
        'user_slug',
   
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function formation(){
        return $this->hasMany(Formation::class);
    }}
