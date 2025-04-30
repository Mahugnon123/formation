<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; // Importez le trait HasApiTokens
use Illuminate\Notifications\Notifiable; // Importez le trait Notifiable

class Role extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'slug', // Ajoutez 'slug' car votre migration a cette colonne et votre seeder l'utilise
        'description', // Ajoutez 'description' si vous prévoyez de l'assigner massivement
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}