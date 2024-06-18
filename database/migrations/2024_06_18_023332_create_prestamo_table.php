<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestamo', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_de_prestamo');
            $table->date('fecha_de_devolucion');
            $table->boolean('devuelto')->default(false);
            $table->foreignId('libro_id')->constrained('libro')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('usuario')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestamo');
    }
};
