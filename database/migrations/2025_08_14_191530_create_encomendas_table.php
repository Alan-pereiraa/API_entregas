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
        Schema::create('encomendas', function (Blueprint $table) {
            $table->id();
            $table->decimal('peso', 8, 2);
            $table->unsignedBigInteger('cliente_remetente_id'); 
            $table->foreign('cliente_remetente_id')->references('id')->on('clientes')->onDelete('cascade'); // FK
            $table->unsignedBigInteger('cliente_destinatario_id'); 
            $table->foreign('cliente_destinatario_id')->references('id')->on('clientes')->onDelete('cascade'); // FK
            $table->unsignedBigInteger('servico_id');
            $table->foreign('servico_id')->references('id')->on('servicos'); //FK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encomendas');
    }
};
