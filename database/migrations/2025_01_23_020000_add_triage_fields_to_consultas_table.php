<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->text('queixaPrincipal')->nullable();
            $table->string('pressaoArterial', 20)->nullable();
            $table->unsignedSmallInteger('frequenciaCardiaca')->nullable();
            $table->unsignedSmallInteger('frequenciaRespiratoria')->nullable();
            $table->decimal('temperatura', 4, 1)->nullable();
            $table->decimal('saturacaoOxigenio', 4, 1)->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('altura', 4, 2)->nullable();
            $table->unsignedTinyInteger('idadeGestacionalSemanas')->nullable();
            $table->unsignedSmallInteger('batimentosFetais')->nullable();
            $table->string('classificacaoRisco')->nullable();
            $table->text('observacoesTriagem')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->dropColumn([
                'queixaPrincipal',
                'pressaoArterial',
                'frequenciaCardiaca',
                'frequenciaRespiratoria',
                'temperatura',
                'saturacaoOxigenio',
                'peso',
                'altura',
                'idadeGestacionalSemanas',
                'batimentosFetais',
                'classificacaoRisco',
                'observacoesTriagem',
            ]);
        });
    }
};
