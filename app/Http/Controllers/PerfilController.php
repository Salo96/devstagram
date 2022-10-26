<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        // dd('hola');
        return view('perfil.index');

    }

    public function store(Request $request){
        // dd('guardar cambios');

        //modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request,[
            'username' => ['required', 'unique:users,username,'. auth()->user()->id, 'min:3', 'max:30'],
            'email' => ['required', 'unique:users,email,'. auth()->user()->id, 'email', 'max:60'],

        ]);

        //viene la imagen del index en el campo name
        if($request->imagen){
            $img = $request->file('imagen');

            //Str::uuid->generar un unico id en la img
            $nombreImg = Str::uuid().".".$img->extension(); 
    
            $imgServe = Image::make($img);
            $imgServe->fit(1000, 1000);
    
            $imgPath = public_path('perfiles').'/'.$nombreImg;
            $imgServe->save($imgPath);
        }

    
        //validacion si trae old_password, password, password_confirmation
        if($request->old_password || $request->password ||  $request->password_confirmation){
            //validacion de contraseña actual
            if(!Hash::check($request->old_password, auth()->user()->password)){

                $this->validate($request,[
                    'old_password' => 'required',
                ]);
                return back()->with('msg', 'contraseña actual incorrecta');
    
            }else{
                $this->validate($request,[
                    'password' => 'required|confirmed|min:6' 
                ]);

                $new_password = Hash::make($request->password);
            }
        }


        //guardar cambio
        $usuario = User::find(auth()->user()->id);
        $usuario->email = $request->email;
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImg ?? auth()->user()->imagen ?? NULL;
        $usuario->password = $new_password ?? auth()->user()->password;
        $usuario->save();


        //redireccionar
        return redirect()->route('posts.index', $usuario->username);
        
    }
}
