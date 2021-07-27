<?php

namespace App\Http\Controllers;

use App\Models\CategoriasReceta;
use App\Models\Receta;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function show(CategoriasReceta $categoria)
    {
        $recetas = Receta::where('categoria_id', $categoria->id)->paginate(10);
        return view('categorias.show', compact('recetas', 'categoria')); 
    }
}
