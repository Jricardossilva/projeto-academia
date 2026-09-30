<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('avaliacoes', function (Blueprint $table) {
            if (! Schema::hasColumn('avaliacoes', 'data_avaliacao')) {
                $table->date('data_avaliacao')->nullable()->after('profissional_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('avaliacoes', function (Blueprint $table) {
            $table->dropColumn('data_avaliacao');
        });
    }
};
