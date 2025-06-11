<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormationView extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'formation_id',
        'user_id',
        'ip_address',
        'viewed_at',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}

