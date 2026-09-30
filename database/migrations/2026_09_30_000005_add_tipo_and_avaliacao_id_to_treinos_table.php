<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('treinos', function (Blueprint $table) {
            if (! Schema::hasColumn('treinos', 'tipo')) {
                $table->string('tipo')->default('generico')->after('nome');
            }
            if (! Schema::hasColumn('treinos', 'avaliacao_id')) {
                $table->unsignedBigInteger('avaliacao_id')->nullable()->after('tipo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('treinos', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'avaliacao_id']);
        });
    }
};
