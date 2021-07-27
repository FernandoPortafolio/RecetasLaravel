<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    public function categoria() {
        return $this->belongsTo(CategoriasReceta::class);
    }

    public function autor() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function likes() {
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
