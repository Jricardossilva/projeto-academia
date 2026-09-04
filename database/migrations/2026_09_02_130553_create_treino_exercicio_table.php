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
        Schema::create('treino_exercicio', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('treino_id');
            $table->unsignedBigInteger('exercicio_id');
            $table->integer('series');
            $table->integer('repeticoes');
            $table->decimal('carga_kg', 8, 2)->nullable();
            $table->string('dia_semana');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treino_exercicio');
    }
};
