<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        //pluck traeme el campo id de la tabla followings, toArray me convierte en array
        //dd(auth()->user()->followings->pluck('id')->toArray());
        
        $ids = auth()->user()->followings->pluck('id')->toArray();
        //whereIn filtra por arreglo, latest ordena de forma ascendente
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        // dd($posts);
        return view('home',[
            'posts' => $posts
        ]);
    }
}
