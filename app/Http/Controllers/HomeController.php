<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriasReceta;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ["except" => "index"]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nuevas = Receta::latest()->take(5)->get();

        $categorias = CategoriasReceta::all();
        $recetas = [];
        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->nombre)] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        // $votadas = Receta::has('likes', '>', 0)->get();
        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();
        return view('home.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
