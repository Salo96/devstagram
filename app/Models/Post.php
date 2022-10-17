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
}
