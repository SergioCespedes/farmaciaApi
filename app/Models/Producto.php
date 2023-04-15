<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Producto extends Model {
    protected $fillable = ['id', 'nombre', 'categoria', 'descripcion','principioActivo','stock','precio', 'activo','fechaVencimiento','imagen','id_laboratorio'];
}

