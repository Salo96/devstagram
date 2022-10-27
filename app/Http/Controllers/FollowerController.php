<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
        //atach sirve cuando relaciona la misma tabla y crear el registro
        $user->followers()->attach( auth()->user()->id );
        return back();
    }

    public function destroy(User $user){
           //detach sirve para eliminar el registro
        $user->followers()->detach( auth()->user()->id );
        return back();
    }
}
