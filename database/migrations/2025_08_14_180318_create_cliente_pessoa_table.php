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
        Schema::create('cliente_pessoa', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('cpf', 11)->unique();
            $table->unsignedBigInteger('cliente_id'); 
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');// FK
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_pessoa');
    }
};
