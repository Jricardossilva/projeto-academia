<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConvidadoSomenteLeituraTest extends TestCase
{
    use RefreshDatabase;

    private function convidado(): Usuario
    {
        return Usuario::create([
            'nome' => 'Convidado', 'email' => 'c@c.com', 'cpf' => '111',
            'senha' => bcrypt('secret1'), 'aceite_termos' => true, 'tipo' => 'convidado',
        ]);
    }

    public function test_convidado_consulta_todas_as_listagens(): void
    {
        $this->actingAs($this->convidado());

        foreach (['usuarios', 'planos', 'matriculas', 'aulas', 'treinos', 'avaliacoes', 'professores', 'parceiros'] as $rota) {
            $this->get("/$rota")->assertOk();
        }
    }

    public function test_convidado_nao_abre_formularios_de_criacao_e_edicao(): void
    {
        $this->actingAs($this->convidado());

        $this->get('/planos/create')->assertForbidden();
        $this->get('/usuarios/1/edit')->assertForbidden();
    }

    public function test_convidado_nao_cria_edita_nem_remove(): void
    {
        $convidado = $this->convidado();
        $this->actingAs($convidado);

        $this->post('/planos', ['nome' => 'X', 'valor' => 10])->assertForbidden();
        $this->put("/usuarios/{$convidado->id}", ['nome' => 'Hack'])->assertForbidden();
        $this->delete("/usuarios/{$convidado->id}")->assertForbidden();

        $this->assertDatabaseHas('usuarios', ['id' => $convidado->id, 'nome' => 'Convidado']);
    }

    public function test_convidado_consegue_sair(): void
    {
        $this->actingAs($this->convidado())->post('/logout')->assertRedirect();
        $this->assertGuest();
    }
}
