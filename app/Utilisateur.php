<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
    'etudiant' => 'App\Etudiant',
    'enseignant' => 'App\Enseignant',
]);

class Utilisateur extends Model
{
    protected $table='utilisateurs';
    public function utilisateurable(){
        return $this->morphTo();
    }
    public function user(){
        return $this->hasOne('App\User');
    }
    public function groupe_académiques(){
        return $this->belongsToMany('App\GroupeAcadémique','groupe_académique_utilisateur');
    }

}
