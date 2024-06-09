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
        Schema::create('adicionar_categorias', function (Blueprint $table) {
            $table->id('codigoadicionarcategoria');
            $table->integer('codigocontacto');
            $table->integer('codigocategoriapersonal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adicionar_categorias');
    }
};
