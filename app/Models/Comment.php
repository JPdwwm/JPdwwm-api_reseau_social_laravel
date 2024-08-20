<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

            /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'image',
        'tags',
        'user_id',
        'post_id'
    ];

    //Charger automatiquement l'utilisateur à chaque fois qu'on récupère un commentaire

    // protected $with = ['user','post'];

    public function post()
    {
        return $this-> belongsTo(Post::class);
    }

    public function user()
    {
        return $this-> belongsTo(User::class);
    }
}
