@extends('layouts.app')

@section('titulo')
    Pagina principal
@endsection

@section('contenido')

@if($posts->count())
    <div class="grid md:grid-col-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"> 
        @foreach ($posts as $post)
            <div>
                <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                    <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="{{ $post->imagen }}">
                </a>
            </div>    
        @endforeach
    </div>

    <div>
        {{ $posts->links('pagination::tailwind') }}
    </div>
@else 
    <p class="text-center">No hay post</p>

@endif


@endsection