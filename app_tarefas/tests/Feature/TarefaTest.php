<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Status;
use App\Models\Tarefa;

class TarefaTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    protected function autenticar()
    {
        $user = User::where('email', 'admin@teste.com')->first();
        $this->assertNotNull($user, 'Usuário admin@teste.com não encontrado.');
        $this->actingAs($user, 'web');
    }

    public function teste_usuario_existente_pode_criar_tarefa()
    {
        $this->autenticar();

        $status = Status::where('descricao', 'Pendente')->first();
        $this->assertNotNull($status, 'Status "Pendente" não encontrado.');

        $dados = [
            'titulo' => 'Tarefa de Teste',
            'descricao' => 'Criada via teste',
            'vencimento' => now()->addDay()->toDateString(),
            'status_id' => $status->id,
        ];

        $resposta = $this->postJson('/api/tarefas', $dados);

        $resposta->assertStatus(201)
                 ->assertJsonFragment(['titulo' => 'Tarefa de Teste']);

        $this->assertDatabaseHas('tarefas', ['titulo' => 'Tarefa de Teste']);
    }

    public function teste_usuario_pode_listar_tarefas()
    {
        $this->autenticar();

        Tarefa::factory()->count(3)->create();

        $resposta = $this->getJson('/api/tarefas');

        $resposta->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function teste_usuario_pode_atualizar_tarefa()
    {
        $this->autenticar();

        $status = Status::where('descricao', 'Pendente')->first();
        $tarefa = Tarefa::create([
            'titulo' => 'Tarefa Original',
            'descricao' => 'Descrição original',
            'vencimento' => now()->addDays(1)->toDateString(),
            'status_id' => $status->id,
        ]);

        $dadosAtualizados = [
            'titulo' => 'Tarefa Atualizada',
            'descricao' => 'Nova descrição',
            'vencimento' => now()->addDays(2)->toDateString(),
            'status_id' => $status->id,
        ];

        $resposta = $this->putJson("/api/tarefas/{$tarefa->id}", $dadosAtualizados);

        $resposta->assertStatus(200)
                 ->assertJsonFragment(['titulo' => 'Tarefa Atualizada']);

        $this->assertDatabaseHas('tarefas', ['titulo' => 'Tarefa Atualizada']);
    }

    public function teste_usuario_pode_excluir_tarefa()
    {
        $this->autenticar();

        $status = Status::where('descricao', 'Pendente')->first();
        $tarefa = Tarefa::create([
            'titulo' => 'Tarefa a excluir',
            'descricao' => 'Será excluída',
            'vencimento' => now()->addDays(1)->toDateString(),
            'status_id' => $status->id,
        ]);

        $resposta = $this->deleteJson("/api/tarefas/{$tarefa->id}");

        $resposta->assertStatus(204);

        $this->assertDatabaseMissing('tarefas', ['id' => $tarefa->id]);
    }
}
