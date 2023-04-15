<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("categoria");
            $table->string("descripcion",10000);
            $table->string("principioActivo");
            $table->integer("stock");
            $table->double("precio");
            $table->integer("activo")->default(1);
            $table->date("fechaVencimiento");
            $table->string("imagen")->nullable();
            $table->foreignId("id_laboratorio")->references("id")->on("laboratorios");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
