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
        Schema::create('agencias', function (Blueprint $table) {
            $table->id();
            $table->string('razao_social', 50)->unique();
            $table->string('nome_fantasia', 100);
            $table->string('cnpj', 14)->unique();
            $table->string('telefone', 11)->unique();
            $table->string('email', 50)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencias');
    }
};
