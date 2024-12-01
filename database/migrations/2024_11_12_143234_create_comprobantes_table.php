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
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();
            $table->string('serie');
            $table->integer('iniciosecuencia');
            $table->integer('finsecuencia');
            $table->date('fechaemision');
            $table->date('fechaexpiracion');
            $table->integer('ultsecuencia')->nullable();
            $table->datetime('fechaultsecuencia')->nullable();
            $table->string('tipo')->nullable();
            $table->string('estado')->default('ACTIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobantes');
    }
};
