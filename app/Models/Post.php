<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Charger automatiquement l'utilisateur à chaque fois qu'on récupère un message

    protected $with = ['user'];

    //Nom de la fonction au singulier car un seul user, cardinalité 1,1

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    //Nom de la fonction au plurier car un message peut regrouper plusieurs commentaires

    public function comments()
    {
        return $this -> hasMany(Comment::class);
    }
}
