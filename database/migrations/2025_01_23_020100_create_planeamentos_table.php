<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planeamentos', function (Blueprint $table) {
            $table->id();
            $table->date('dataPlaneamento');
            $table->string('metodo');
            $table->string('estado')->default('activo');
            $table->date('proximaData')->nullable();
            $table->text('observacoes')->nullable();
            $table->foreignId('pacienteID')
                ->constrained('pacientes')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planeamentos');
    }
};
