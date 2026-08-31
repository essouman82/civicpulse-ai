<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $fillable = [
        'incident_id',
        'agent',
        'description',
        'date_intervention',
        'statut',
    ];

    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }
}