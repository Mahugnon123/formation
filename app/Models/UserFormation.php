<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class UserFormation extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'formations'
    ];

    public function isInscrit($formationId)
    {
        $formations = is_array($this->formations) ? $this->formations : json_decode($this->formations, true);
        foreach ($formations as $fmt) {
            if ((string)$fmt['id'] === (string)$formationId) {
                return true;
            }
        }
        return false;
    }

}
