@extends('layouts.app')

@section('content')
<article class="contenido-receta bg-white p-5 shadow">
    <h1 class="text-center mb-4">{{ $receta->titulo }}</h1>
    @if (Auth::user() && Auth::user()->id === $receta->id)
    <a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}" class="btn btn-primary d-block d-md-inline-block mt-2">Editar</a>
    @endif

    <div class="imagen-receta text-center">
        <img
            src="/storage/{{ $receta->imagen }}"
            alt="Imagen de la Receta"
            class="img-responsive w-100"
        >
    </div>

    <div class="receta-meta">
        <p class="mt-3">
            <span class="font-weight-bold text-primary">Escrito en:</span>
            <a class="text-dark" href="{{ route('categorias.show', ['categoria' => $receta->categoria->id]) }}">
            {{ $receta->categoria->nombre }}
            </a>
        </p>
        <p>
            <span class="font-weight-bold text-primary">Autor:</span>

            <a class="text-dark" href="{{ route('perfiles.show', ['perfil' => $receta->autor->id]) }}">
            {{ $receta->autor->name }}
            </a>
        </p>
        <p>
            <span class="font-weight-bold text-primary">Fecha:</span>
            <fecha-receta fecha="{{ $receta->created_at }}"></fecha-receta>
        </p>
        <div class="ingredientes">
            <h2 class="my-3 text-primary">Ingredientes</h2>
            {!! $receta->ingredientes !!}
        </div>
        <div class="preparacion">
            <h2 class="my-3 text-primary">Preparacion</h2>
            {!! $receta->preparacion !!}
        </div>


        <div class="row justify-content-center text-center">
            <like-button
                receta-id="{{ $receta->id }}"
                like="{{ $like }}"
                likes="{{ $likes }}"
            ></like-button>
        </div>

    </div>
</article>


@endsection