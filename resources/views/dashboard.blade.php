@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="imagen usuario">
            </div>
            <div class="w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <p class="text-gray-700 text-2xl mb-3">{{ $user->username }}</p>

                <p class="text-gray-800 mb-3 font-bold">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 mb-3 font-bold">
                    0
                    <span class="font-normal">Post</span>
                </p>

            </div>

        </div>
    </div>

@endsection