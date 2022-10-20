<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //el usuario debe estar autenticado
    public function __construct(){
        $this->middleware('auth');
    }

    public function index( User $user ){


        // dd($user->id);

        $posts = Post::where('user_id', $user->id)->paginate(10);
        // dd($posts);

        return view('dashboard',[
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store( ){
        $rules = [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
            'user_id' => 'required'
        ];

        request()->validate(  $rules );

        Post::create(request()->all());

        return redirect()->route('posts.index', auth()->user()->username);
    }


}
