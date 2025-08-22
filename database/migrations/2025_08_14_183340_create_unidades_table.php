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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('telefone', 11)->unique();
            $table->string('endereco', 100);
            $table->boolean('unidade_ativa')->default(true);
            $table->unsignedBigInteger('agencia_id');
            $table->foreign('agencia_id')->references('id')->on('agencias')->onDelete('cascade'); // FK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
