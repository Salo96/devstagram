<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //el usuario debe estar autenticado
    public function __construct(){
        $this->middleware('auth')->except(['show', 'index']);
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

    public function show(User $user, Post $post){
        return view('posts.show',[
            'post' => $post,
            'user' =>$user
        ]);
    }

    public function destroy(Post $post){
        // dd('eliminando', $post->id);
        // if($post->user_id === auth()->user()->id){
        //     $post->delete();
        //     return redirect()->route('posts.index', auth()->user()->username);
        // }else{
        //     return;
        // }

        //eliminar la img
        $img_path = public_path('uploads/' . $post->imagen);

        if(File::exists($img_path)){
            unlink($img_path);
        }

        //viene del policy para tener la logica ahi, si es el post del usuario
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index', auth()->user()->username);
       
    }


}
