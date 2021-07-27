<?php

namespace App\Http\Controllers;

use App\Models\CategoriasReceta;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $recetas = Auth::user()->recetas;

        $usuario = Auth::user();
        $recetas = Receta::where('user_id', $usuario->id)->paginate(10);

        return view('recetas.index')
            ->with('recetas', $recetas)
            ->with('usuario', $usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categorias = DB::table('categorias_receta')->get()->pluck('nombre', 'id');
        $categorias = CategoriasReceta::all(['id', 'nombre']);
        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|min:3',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image|max:4096',
        ]);

        $ruta_imagen = $this->uploadImage($request['imagen']);
        $receta = new Receta();
        $receta->titulo = $data['titulo'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];
        $receta->user_id = Auth::user()->id;
        $receta->categoria_id = $data['categoria'];
        $receta->imagen = $ruta_imagen;
        $receta->save();

        return redirect()->route('recetas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;
        $likes = $receta->likes->count();
        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view', $receta);
        $categorias = CategoriasReceta::all(['id', 'nombre']);
        return view('recetas.edit', compact('receta', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //Revisar el policy
        $this->authorize('update', $receta);

        $data = $request->validate([
            'titulo' => 'required|min:3',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ]);

        $receta->titulo = $data['titulo'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];
        $receta->categoria_id = $data['categoria'];
        $oldImage = null;
        if ($request->imagen) {
            $ruta_imagen = $this->uploadImage($request['imagen']);
            $oldImage = $receta->imagen;
            $receta->imagen = $ruta_imagen;
        }
        if ($receta->save() && $oldImage)
            Storage::delete('public/' . $oldImage);

        return redirect()->route('recetas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //Revisar el policy
        // $this->authorize('update', $receta);
        $oldImage = $receta->imagen;
        if ($receta->delete())
            Storage::delete('public/' . $oldImage);

        return redirect()->route('recetas.index');
    }

    private function uploadImage($image)
    {
        $ruta_imagen = $image->store('uploads', 'public');
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();
        return $ruta_imagen;
    }

    public function search(Request  $request)
    {
        $busqueda = $request->buscar;
        $recetas = Receta::where('titulo', 'like', "%$busqueda%")->paginate(10);
        $recetas->appends(['buscar' => $busqueda]);
        return view('busquedas.show', compact('recetas', 'busqueda'));
    }
}
