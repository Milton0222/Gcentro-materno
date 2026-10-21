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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->date('dataConsulta');
            $table->time('hora');
            $table->string('doutor');
            $table->decimal('valor')->nullable()->default(0);
            $table->string('tipoConsulta');
            $table->unsignedBigInteger('pacienteID');

            $table->foreign('pacienteID')->references('id')->on('pacientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
