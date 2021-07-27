@extends('layouts.app')

@section('hero')
<div class="hero-categorias">
    <form
        action="{{ route('recetas.search') }}"
        class="container h-100"
    >
        <div class="row h-100 align-items-center">
            <div class="col-md-4 texto-buscar">
                <p class="display-4">Encuentra una receta para tu proxima comida</p>
                <input
                    type="search"
                    name="buscar"
                    class="form-control"
                    placeholder="Buscar Receta"
                >
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')

<div class="container nuevas-recetas">
    <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Ultimas recetas</h2>
    <div class="owl-carousel owl-theme">
        @foreach ($nuevas as $receta)
        <div class="card">
            <img
                src="/storage/{{ $receta->imagen }}"
                alt="Imgen Receta"
                class="card-img-top"
            >
            <div class="card-body">
                <h3>{{ Str::title( $receta->titulo) }}</h3>
                <p>{{ Str::words(strip_tags($receta->preparacion), 20, '...') }}</p>
                <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-primary font-weight-bold text-uppercase">Ver receta</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container">
    <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Recetas Más Votadas</h2>
    <div class="row">
        @foreach ($votadas as $receta)
        @include('partials.receta')
        @endforeach
    </div>
</div>

@foreach ($recetas as $key => $grupo)
<div class="container">
    <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{ str_replace('-', ' ', $key) }}</h2>
    <div class="row">
        @foreach ($grupo as $receta)
        @include('partials.receta')
        @endforeach
    </div>
</div>
@endforeach

@endsection