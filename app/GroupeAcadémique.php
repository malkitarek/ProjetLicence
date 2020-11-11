<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupeAcadémique extends Model
{   protected $table='groupe_académiques';
    public function utilisateurs(){
        return $this->belongsToMany('App\Utilisateur','groupe_académique_utilisateur');
    }
}
