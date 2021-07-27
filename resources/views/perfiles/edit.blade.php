@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')
<a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Regresar</a>
@endsection

@section('content')

<div class="container">
    <h1 class="text-center">Editar mi Perfil</h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form
                action="{{ route('perfiles.update', ['perfil' => $perfil->id]) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        placeholder="Tu Nombre"
                        value="{{ $perfil->usuario->name }}"
                        class="form-control"
                    >
                </div>

                <div class="form-group">
                    <label for="nombre">Sitio Web</label>
                    <input
                        type="text"
                        name="url"
                        id="url"
                        placeholder="Tu Sitio Web"
                        value="{{ $perfil->usuario->url }}"
                        class="form-control"
                    >
                </div>

                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <input
                        type="hidden"
                        id="biografia"
                        name="biografia"
                        value="{{ $perfil->biografia }}"
                    >
                    <trix-editor
                        input="biografia"
                        class="form-control trix-content"
                    ></trix-editor>
                </div>

                <div class="form-group">
                    <label for="imagen">Elige la imagen</label>
                    <input
                        type="file"
                        class="form-control-file"
                        name="imagen"
                    >
                    @if ($perfil->imagen)
                    <div class="preview mt-3">
                        <p>Imagen Actual</p>
                        <img
                            src="/storage/{{ $perfil->imagen }}"
                            alt="Imagen Actual"
                            class="img-responsive w-25"
                        >
                    </div>
                    @endif
                </div>

                <div class="form-group">
                    <input type="submit" value="Actualzar Perfil" class="btn btn-primary">
                </div>

            </form>
        </div>
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