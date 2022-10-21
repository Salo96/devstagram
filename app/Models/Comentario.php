<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comentarios'
    ];

    public function user(){
        // los cometarios pertenece a un usuario comentario<-usuario
        return $this->belongsTo(User::class);
    }
}
