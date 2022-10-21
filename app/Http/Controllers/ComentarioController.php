<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $r){

        
        //validar
        $this->validate($r, [
            'comentarios' => 'required|max:255',
            'user_id'=> 'required',
            'post_id' => 'required'
        ]);

        //save bbdd
        Comentario::create(request()->all());
        // Comentario::create([
        //     'user_id'=> auth()->user()->id,
        //     'post_id' => $post->id,
        //     'comentarios' => $r->comentarios,
        // ]);

        //msg
        return back()->with('msg', 'Comentario se realizo correctamente');
    }
}
