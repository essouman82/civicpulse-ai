<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
   protected $fillable = [

    'user_id',

    'titre',

    'description',

    'categorie',

    'priorite',

    'service',

    'score_ia',

    'explication_ia',

    'mots_cles',

    'latitude',

    'longitude',

    'statut',

];
protected $casts = [

    'mots_cles' => 'array',

];
    // Un incident appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un incident possède plusieurs interventions
    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
}
