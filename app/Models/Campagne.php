<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Don;

class Campagne extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'objectif',
        'montant_collecte',
        'statut',
        'beneficiaire_id'
    ];

    // relations

    public function beneficiaire() {
        return $this->belongsTo(User::class, 'beneficiaire_id');
    }

    public function dons() {
        return $this->hasMany(Don::class);
    }
}
