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
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('profissional_id')->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('altura', 5, 2)->nullable();
            $table->decimal('biceps_direito', 5, 2)->nullable();
            $table->decimal('biceps_esquerdo', 5, 2)->nullable();
            $table->decimal('antebraco_direito', 5, 2)->nullable();
            $table->decimal('antebraco_esquerdo', 5, 2)->nullable();
            $table->decimal('coxa_direita', 5, 2)->nullable();
            $table->decimal('coxa_esquerda', 5, 2)->nullable();
            $table->decimal('panturrilha_direita', 5, 2)->nullable();
            $table->decimal('panturrilha_esquerda', 5, 2)->nullable();
            $table->decimal('cintura', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
