<?php

namespace App\Console\Commands;

use Database\Seeders\AdminUserSeeder;
use Illuminate\Console\Command;

class CriarAdminCommand extends Command
{
    protected $signature = 'admin:create
        {--nome= : Nome do administrador}
        {--email= : E-mail de acesso}
        {--cpf= : CPF do administrador}
        {--senha= : Senha de acesso}';

    protected $description = 'Cria (ou promove) o usuário administrador para o primeiro acesso ao sistema';

    public function handle(): int
    {
        $nome  = $this->option('nome')  ?: $this->ask('Nome do administrador', 'Administrador');
        $email = $this->option('email') ?: $this->ask('E-mail de acesso', 'admin@admin.com');
        $cpf   = $this->option('cpf')   ?: $this->ask('CPF', '00000000000');
        $senha = $this->option('senha') ?: ($this->secret('Senha de acesso (mín. 6 caracteres)') ?: 'admin123');

        $usuario = (new AdminUserSeeder())->criar($nome, $email, $cpf, $senha);

        $this->newLine();
        $this->info("Administrador pronto para uso:");
        $this->line("  E-mail: {$usuario->email}");
        $this->line("  Senha:  {$senha}");
        $this->newLine();
        $this->comment('Troque a senha após o primeiro acesso.');

        return self::SUCCESS;
    }
}
