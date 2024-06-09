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
        Schema::create('bonificacions', function (Blueprint $table) {
            $table->id();
            $table->integer('codigocliente');
            $table->integer('codigocampana');
            $table->integer('codigocontacto');
            $table->date('fecha');
            $table->integer('bonificacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonificacions');
    }
};
