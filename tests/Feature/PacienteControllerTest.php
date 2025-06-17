<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paciente;
use App\Models\Responsavel;

class PacienteControllerTest extends TestCase
{
     use RefreshDatabase;

    /** @test */
    public function criar_paciente_e_dois_responsaveis()
    {
        $response = $this->post(route('paciente.store'), [
            'paciente_nome' => 'João da Silva',
            'paciente_cpf' => '123.456.789-00',
            'paciente_data_nascimento' => '2000-01-01',
            'paciente_endereco' => 'Rua Exemplo, 123',
            'paciente_cep' => '12345-678',

            'paciente_primeiro_responsavel_nome' => 'Maria da Silva',
            'paciente_primeiro_responsavel_cpf' => '111.111.111-11',
            'paciente_primeiro_responsavel_parentesco' => 'Mãe',

            'paciente_segundo_responsavel_nome' => 'José da Silva',
            'paciente_segundo_responsavel_cpf' => '222.222.222-22',
            'paciente_segundo_responsavel_parentesco' => 'Pai',
        ]);

        $response->assertRedirect(route('paciente.index'));
        $response->assertSessionHas('success');
        $paciente = Paciente::where('cpf', '12345678900')->firstOrFail();

        $this->assertDatabaseHas('pacientes', [
            'nome' => 'João da Silva',
            'cpf' => '12345678900',
        ]);

        $this->assertDatabaseHas('responsaveis', [
            'nome' => 'Maria da Silva',
            'cpf' => '11111111111',
        ]);

        $this->assertDatabaseHas('responsaveis', [
            'nome' => 'José da Silva',
            'cpf' => '22222222222',
        ]);

        // se os responsáveis pertencem ao paciente
        $this->assertDatabaseHas('responsaveis', [
            'paciente_id' => $paciente->id,
            'nome' => 'Maria da Silva',
        ]);

        $this->assertDatabaseHas('responsaveis', [
            'paciente_id' => $paciente->id,
            'nome' => 'José da Silva',
        ]);
    }
}
