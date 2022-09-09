<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $r){
        // dd($r->get('email'));
        //validacion
        $this->validate( $r,[
            'name' => 'required|min:4',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
            
        ]);

        // dd('creando usuario');

        // guardo en la bd
        // User::create(request()->all());
        User::create([
            'name' => $r->name,
            'username' => Str::slug($r->username),
            'email' => $r->email,
            'password' => Hash::make($r->password)
        ]);

        //autenticar usuario
        // auth()->attempt([
        //     'email' => $r->email,
        //     'password' => $r->password
        // ]);

        //otra forma de autenticacion
        auth()->attempt( $r->only('email', 'password'));


        //redireccionaar
        return redirect()->route('posts.index');

    }
}
