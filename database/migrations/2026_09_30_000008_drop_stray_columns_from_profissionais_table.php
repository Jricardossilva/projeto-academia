<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Colunas email/cpf/senha ficaram no banco de um schema antigo (a migration
     * de criação de `profissionais` nunca as declarou); Profissional não tem
     * login próprio no domínio atual, então essas colunas não pertencem à tabela.
     */
    public function up(): void
    {
        Schema::table('profissionais', function (Blueprint $table) {
            foreach (['email', 'cpf', 'senha'] as $coluna) {
                if (Schema::hasColumn('profissionais', $coluna)) {
                    $table->dropColumn($coluna);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('profissionais', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('cpf')->nullable();
            $table->string('senha')->nullable();
        });
    }
};
