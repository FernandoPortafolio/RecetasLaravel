@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')
<a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Regresar</a>

@endsection

@section('content')
<h2 class="text-center mb-5">Crear nueva Receta</h2>

<div class="row justify-content-center mt-5">
  <div class="col-md-8">
    <form
      method="POST"
      action="{{ route('recetas.store') }}"
      novalidate
      enctype="multipart/form-data"
    >
      @csrf
      <div class="form-group">
        <label for="titulo">Titulo Receta</label>
        <input
          type="text"
          name="titulo"
          class="form-control @error('titulo') is-invalid @enderror"
          value="{{ old('titulo') }}"
          id="titulo"
          placeholder="Titulo Receta"
        >
        @error('titulo')
        <span
          class="invalid-feedback d-block"
          role="alert"
        >
          <strong>{{$message}}</strong>
        </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="cateogria">Categoría</label>
        <select
          name="categoria"
          id="categria"
          class="form-control @error('categoria') is-invalid @enderror"
        >
          <option
            value=""
            selected
            disabled
          >--Seleccione--</option>
          @foreach ($categorias as $cat)
          <option
            value="{{$cat->id}}"
            {{old('categoria') == $cat->id ? 'selected' : ''}}
          >{{$cat->nombre}}</option>
          @endforeach
        </select>

        @error('categoria')
        <span
          class="invalid-feedback d-block"
          role="alert"
        >
          <strong>{{$message}}</strong>
        </span>
        @enderror

      </div>

      <div class="form-group mt-3">
        <label for="ingredientes">Ingredientes</label>
        <input
          type="hidden"
          id="ingredientes"
          name="ingredientes"
          value="{{ old('ingredientes') }}"
        >
        <trix-editor
          input="ingredientes"
          class="form-control @error('ingredientes') is-invalid @enderror"
        ></trix-editor>

        @error('ingredientes')
        <span
          class="invalid-feedback d-block"
          role="alert"
        >
          <strong>{{$message}}</strong>
        </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="preparacion">Preparación</label>
        <input
          type="hidden"
          id="preparacion"
          name="preparacion"
          value="{{ old('preparacion') }}"
        >
        <trix-editor
          input="preparacion"
          class="form-control @error('preparacion') is-invalid @enderror trix-content"
        ></trix-editor>

        @error('preparacion')
        <span
          class="invalid-feedback d-block"
          role="alert"
        >
          <strong>{{$message}}</strong>
        </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="imagen">Elige la imagen</label>
        <input
          type="file"
          class="form-control-file"
          name="imagen"
        >
        @error('imagen')
        <span
          class="invalid-feedback d-block"
          role="alert"
        >
          <strong>{{$message}}</strong>
        </span>
        @enderror
      </div>

      <div class="form-group">
        <input
          type="submit"
          class="btn btn-primary"
          value="Agregar Receta"
        >
      </div>

    </form>

  </div>
</div>

@endsection

@section('scripts')
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"
  integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
  defer
></script>
@endsection