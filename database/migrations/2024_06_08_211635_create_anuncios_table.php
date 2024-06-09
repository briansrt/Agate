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
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id('codigoanuncio');
            $table->integer('codigocliente');
            $table->integer('codigocampana');
            $table->integer('codigotiposanuncio');
            $table->string('descripcion');
            $table->date('fechainicio');
            $table->date('fechafin');
            $table->integer('valor');
            $table->tinyInteger('finalizado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
};
