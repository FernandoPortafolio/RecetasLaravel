<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RecetaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

//Recetas
Route::prefix('/recetas')->group(function () {
    Route::get('/', [RecetaController::class, 'index'])->name('recetas.index');
    Route::get('/create', [RecetaController::class, 'create'])->name('recetas.create');
    Route::post('/', [RecetaController::class, 'store'])->name('recetas.store');
    Route::get('/{receta}', [RecetaController::class, 'show'])->name('recetas.show');
    Route::get('/{receta}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
    Route::put('/{receta}', [RecetaController::class, 'update'])->name('recetas.update');
    Route::delete('/{receta}', [RecetaController::class, 'destroy'])->name('recetas.destroy');

    Route::post('/{receta}/like', [LikesController::class, 'update'])->name('likes.update');
});

//Perfiles
Route::prefix('/perfiles')->group(function () {
    Route::get('/{perfil}', [PerfilController::class, 'show'])->name('perfiles.show');
    Route::get('/{perfil}/edit', [PerfilController::class, 'edit'])->name('perfiles.edit');
    Route::put('/{perfil}', [PerfilController::class, 'update'])->name('perfiles.update');
});

Route::get('/categoria/{categoria}', [CategoriasController::class, 'show'])->name('categorias.show');
Route::get('buscar', [RecetaController::class, 'search'])->name('recetas.search');
