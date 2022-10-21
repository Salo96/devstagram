@extends('layouts.app')
@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')

<div class="container mx-auto flex">
    <div class="md:w-1/2">
        <img src="{{ asset('uploads'). '/' . $post->imagen }}" alt="{{ $post->titulo }}">

        <div class="p-3">
            <p>0 likes</p>
        </div>

        <div>
            <p class="font-bold">{{ $post->user->username }}</p>
            <p class="text-sm text-gray-500">
                {{ $post->created_at->diffForHumans() }}
            </p>
            <p class="mt-5">
                {{ $post->descripcion }}
            </p>
        </div>

        @auth
            @if ($post->user_id === auth()->user()->id)   
                <form action="{{ route('posts.detroy', $post) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input 
                        type="submit" 
                        value="Eliminar publicación"
                        class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-3 cursor-pointer"
                    >
                </form>
            @endif
        @endauth
    </div>

    
    <div class="md:w-1/2 p-5">
        <div class="shadow bg-white p-5 mb-5">
            <p class="text-xl font-bold text-center mb-4">
                agregar un nuevo comentario
            </p>

            @if(session('msg'))
                <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center upercase font-bold">
                    {{session('msg')}}
                </div>
            @endif

            @auth 

                <form method="POST" action="{{ route('comentario.store',  ['post' => $post, 'user' => $user]) }}">
                    @csrf
                    <div class="mb-5">
                        <label for="comentarios" class="mb-2 block uppercase text-gray-500 font-bold">
                            Añade un comentarios 
                        </label>

                        <textarea 
                            id="comentarios"
                            name="comentarios"
                            placeholder="comentarios de la publicación"
                            class="border p-3 w-full rounded-lg
                                @error('comentarios')
                                    border-red-500
                                @enderror
                            "

                        ></textarea>
                        @error('comentarios')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                        <div class="mb-5">
                            <input 
                                name="user_id"
                                type="hidden" 
                                value="{{auth()->user()->id}}"
                            >
                            <input 
                                name="post_id"
                                type="hidden" 
                                value="{{$post->id}}"
                            >
                        </div>

                    <input 
                        type="submit" 
                        value="Crear Comentario" 
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase
                        font-bold w-full p-3 text-white rounded-lg"
                    >

                </form>

            @endauth

            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                {{-- {{ dd($post->comentarios) }} --}}
                @if ($post->comentarios->count())

                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                {{$comentario->user->username}}
                            </a>
                            <p>{{ $comentario->comentarios }}</p>
                            <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach

                @else
                    <p class="p-10 text-center">No hay comentarios</p>
                @endif
            </div>
        </div>
    </div>


</div>
    
@endsection