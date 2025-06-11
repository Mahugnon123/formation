<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'birthday',
        'pays',
        'slug',
        'email',
        'role_id',
        'photo_profil',
        'password',
        'pseudo',
        'biographie',
        'a_propos',
        'sex',
        'link_info',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function planifier(){
        return $this->hasMany(Planifier::class);
    }
    public function requete(){
        return $this->hasMany(Requete::class);
    }
    public function forumReponse(){
        return $this->hasMany(ForumReponse::class);
    }
    public function role(){
        return $this->hasMany(Role::class);
    }
    public function historique(){
        return $this->hasMany(Historique::class);
    }
    
    public function avis(){
        return $this->hasMany(Avis::class);
    }
    
    public function formation(){
        return $this->belongsToMany(Formation::class);
    }

    public function certification(){
        return $this->hasMany(Certification::class);
    }
    
    public function statut(){
        return $this->hasMany(statut::class);
    }
    public function question(){
        return $this->hasMany(Question::class);
    }
    public function test(){
        return $this->belongsToMany(Test::class);
    }
    public function formations()
    {
        return $this->hasMany(UserFormation::class, 'user_id', 'id');
    }

}
