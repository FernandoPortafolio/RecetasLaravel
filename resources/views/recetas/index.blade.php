@extends('layouts.app')

@section('botones')
<a href="{{route('recetas.create')}}" class="btn btn-primary mr-2 text-white">Crear Receta</a>

@endsection

@section('content')
<h2 class="text-center mb-5">Recetas</h2>

<div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-primary text-light">
            <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Categoría</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($recetas as $receta)
            <tr>
                <td>{{ $receta->titulo }}</td>
                <td>{{ $receta->categoria->nombre }}</td>
                <td>
                    <eliminar-receta receta-id="{{ $receta->id}}"></eliminar-receta>
                    <a href="{{ route('recetas.edit', ['receta' => $receta->id ]) }}" class="btn btn-dark btn-sm">Editar</a>
                    <a href="{{ route('recetas.show', ['receta' => $receta->id ]) }}" class="btn btn-info btn-sm">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="col-12 mt-4 justify-content-center d-flex">{{ $recetas->links() }}</div>

    <h2 class="text-center my-5">Recetas que te gustan</h2>
    <div class="col-md-10 mx-auto bg-white p-3">
        <ul class="list-group">
            @foreach ($usuario->meGusta as $recetas)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <p>{{ $receta->titulo }}</p>
                @if (count($usuario->meGusta) > 0)
                <a class="btn btn-outline-success text-uppercase" href="{{ route('recetas.show', ['receta' => $receta->id]) }}"> Ver</a>
                @else
                <p class="text-center">Aún no tienes recetas guardadas <small>Dale me gusta a las recetas y aparecerán aquí</small></p>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection