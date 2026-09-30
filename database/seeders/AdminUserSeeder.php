<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Cria o administrador padrão de primeiro acesso, usando valores do .env
     * quando disponíveis (ADMIN_NOME, ADMIN_EMAIL, ADMIN_CPF, ADMIN_SENHA).
     */
    public function run(): void
    {
        $this->criar(
            env('ADMIN_NOME', 'Administrador'),
            env('ADMIN_EMAIL', 'admin@admin.com'),
            env('ADMIN_CPF', '00000000000'),
            env('ADMIN_SENHA', 'admin123'),
        );
    }

    /**
     * Cria o usuário admin ou, se o e-mail já existir, apenas promove/atualiza a senha.
     */
    public function criar(string $nome, string $email, string $cpf, string $senha): Usuario
    {
        return Usuario::updateOrCreate(
            ['email' => $email],
            [
                'nome' => $nome,
                'cpf' => $cpf,
                'senha' => Hash::make($senha),
                'aceite_termos' => true,
                'tipo' => 'admin',
            ]
        );
    }
}
