<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(){
        // un post pertenece a un usuario usuario <- post
        return $this->belongsTo(User::class)->select(['name', 'username']);//->solo esto quiero que me traiga
    }

    public function comentarios(){
        // un post tiene muchos comentarios post ->comentarios
        return $this->hasMany(Comentario::class);
    }

    public function likes(){
        // un post tiene muchos like post ->like
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        //likes -> posicionarse la tabla de like
        //contains -> contiene en la columna user_id contiene este usuario user->id de este post
        return $this->likes->contains('user_id', $user->id);
    }
}
