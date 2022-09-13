<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $r){

        $img = $r->file('file');

        //Str::uuid->generar un unico id en la img
        $nombreImg = Str::uuid().".".$img->extension();

        $imgServe = Image::make($img);
        $imgServe->fit(1000, 1000);

        $imgPath = public_path('uploads').'/'.$nombreImg;
        $imgServe->save($imgPath);

        return response()->json(["imagen" =>$nombreImg ]);
    }
}
