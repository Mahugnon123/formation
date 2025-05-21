<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requete extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'description',
        'user_id',
        'slug',
        'formation_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function reponses()
    {
        return $this->hasMany(ForumReponse::class, 'requete_id');
    }

    public function fichier()
    {
        return $this->morphMany(Fichier::class, 'fichierable'); // Correction si nécessaire
    }
}