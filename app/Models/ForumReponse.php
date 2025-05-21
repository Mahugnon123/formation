<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReponse extends Model
{
    use HasFactory;

    protected $table = 'forum_reponses';
    protected $fillable = [
        'parent_id',
        'description',
        'requete_id',
        'user_id',
        'slug',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requete()
    {
        return $this->belongsTo(Requete::class);
    }

    public function parent()
    {
        return $this->belongsTo(ForumReponse::class, 'parent_id');
    }
}