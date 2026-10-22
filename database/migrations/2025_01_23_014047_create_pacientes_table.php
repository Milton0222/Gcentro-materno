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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome',50);
            $table->enum('genero',['F','M']);
            $table->date('dataNascimento');
            $table->string('morada',50)->nullable();
            $table->string('contacto', 9)->nullable()->unique();
            $table->string('tipoPaciente')->nullable();
            $table->string('estado')->nullable();
            $table->string('saude')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
