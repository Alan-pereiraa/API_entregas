<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('servicos', function (Blueprint $table) {
            $table->enum('tipo_calculo', [
                'por_peso',
                'por_faixa',
                'preco_fixo',
                'por_distancia'
            ])->default('por_peso')->after('prazo_dias');
        });
    }

    public function down(): void
    {
        Schema::table('servicos', function (Blueprint $table) {
            $table->dropColumn('tipo_calculo');
        });
    }
};
