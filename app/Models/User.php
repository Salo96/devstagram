<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        //one to many
        // un usuario pertenece a MUCHO post usuario -> post
        return $this->hasMany(Post::class);
    }

    public function likes(){
        //un usuario le puede dar varios like
        return $this->hasMany(Like::class);
    }

    //amacena los seguidores de un usuario
    public function followers(){
        //un usuario tiene mucho seguidores(belongsToMany), la tabla se llama followers, ademas agregar las llaves foraneas
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

        //almacenar  los que seguimos
    public function followings(){
        //un usuario tiene mucho seguidores(belongsToMany), la tabla se llama followers, ademas agregar las llaves foraneas
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }


    public function siguiendo(User $user){
        //accede al metodo followers y revisa si es seguidor de la persona,contains sirve para iterar la coleccion de laa bbddd si ya es seguidor
        return $this->followers->contains($user->id);
    }


}
