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
        Schema::create('adicionar_ideas', function (Blueprint $table) {
            $table->id('codigoadicionarideas');
            $table->integer('codigocliente');
            $table->integer('codigocampana');
            $table->integer('codigoanuncio');
            $table->date('fecha');
            $table->string('idea');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adicionar_ideas');
    }
};
