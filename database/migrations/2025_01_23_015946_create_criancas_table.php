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
        Schema::create('criancas', function (Blueprint $table) {
            $table->id();
            $table->enum('genero',['F','M']);
            $table->date('dataParto');
            $table->string('nome',50);
            $table->decimal('peso')->nullable();
            $table->time('hora')->nullable();

            $table->unsignedBigInteger('partoID');
            $table->foreign('partoID')->references('id')->on('partos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criancas');
    }
};
