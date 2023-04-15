<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Laboratorio extends Model {
    protected $fillable = ['id', 'nombre_laboratorio', 'activo'];
}
