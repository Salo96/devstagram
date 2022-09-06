<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);
    }
}
