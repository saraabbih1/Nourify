<?php

use Illuminate\Database\Eloquent\Model;

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
