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
        Schema::create('rastreamentos', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('observacoes', 100)->nullable();
            $table->unsignedBigInteger('encomenda_id');
            $table->foreign('encomenda_id')->references('id')->on('encomendas')->onDelete('cascade'); // FK
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades')->constrained(); // FK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rastreamentos');
    }
};
