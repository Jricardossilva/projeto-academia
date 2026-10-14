<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConvidadoUserSeeder extends Seeder
{
    /**
     * Cria o usuário convidado (somente leitura), usando valores do .env
     * quando disponíveis (CONVIDADO_NOME, CONVIDADO_EMAIL, CONVIDADO_CPF, CONVIDADO_SENHA).
     */
    public function run(): void
    {
        (new AdminUserSeeder())->criar(
            env('CONVIDADO_NOME', 'Convidado'),
            env('CONVIDADO_EMAIL', 'convidado@academia.com'),
            env('CONVIDADO_CPF', '11111111111'),
            env('CONVIDADO_SENHA', 'convidado123'),
            'convidado',
        );
    }
}
