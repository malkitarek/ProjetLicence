<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Etudiant extends Model
{
    protected $table =  'etudiants';
    public function utilisateurs(){
        return $this->morphMany('App\Utilisateur','utilisateurable');
    }
}
