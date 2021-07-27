<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img
            src="/storage/{{ $receta->imagen }}"
            alt="Imagen Receta"
            class="card-img-top"
        >
        <div class="card-body">
            <h3>{{ Str::title( $receta->titulo) }}</h3>
            <div class="meta-receta d-flex justify-content-between">
                <p class="text-primary font-weight-bold fecha">
                    <fecha-receta fecha="{{ $receta->created_at }}"></fecha-receta>
                </p>
                <p>{{ $receta->likes->count() }} Les gustó</p>
            </div>
            <div class="card-text">
                <p>{{ Str::words(strip_tags($receta->preparacion), 20, '...') }}</p>
            </div>
            <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-primary font-weight-bold text-uppercase">Ver receta</a>
        </div>
    </div>
</div>