<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $r){
        $this->validate( $r,[
            'email' => 'required|email|max:60',
            'password' => 'required',
        ]);

        if(!auth()->attempt($r->only('email', 'password'))){
            return back()->with('msg', 'credenciales incorrecta');
        }

        return redirect()->route('posts.index');
    }
}
