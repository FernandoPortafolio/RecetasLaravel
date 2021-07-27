<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(Perfil $perfil)
    {
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(6);
        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    public function edit(Perfil $perfil)
    {
        $this->authorize('view', $perfil);
        return view('perfiles.edit', compact('perfil'));
    }

    public function update(Request $request, Perfil $perfil)
    {

        $this->authorize('update', $perfil);

        //Guardar informacion
        $user = auth()->user();
        $user->url = $request['url'];
        $user->name = $request['nombre'];
        $user->save();

        //Si el usuario sube una imagen
        if ($request->imagen) {
            $ruta_imagen = $this->uploadImage($request['imagen']);
            $oldImage = $user->perfil->imagen;
            $imagen = ['imagen' => $ruta_imagen];
        }

        $user->perfil->update(array_merge(
            ['biografia' => $request['biografia']],
            $imagen ?? []
        ));

        if (isset($oldImage))
            Storage::delete('public/' . $oldImage);

        //redireccionar
        return redirect()->route('perfiles.show', ['perfil' => $perfil->id]);
    }

    private function uploadImage($image)
    {
        $ruta_imagen = $image->store('perfiles', 'public');
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
        $img->save();
        return $ruta_imagen;
    }
}
