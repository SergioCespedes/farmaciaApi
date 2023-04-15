<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Usuario  extends Model {
    protected $fillable = ['id', 'cedula', 'nombre_usuario','apellido_usuario','telefono','email','activo'];
}
