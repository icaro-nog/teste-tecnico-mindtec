<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\Paciente;
use App\Models\Responsavel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::with('responsaveis')->get();

        return view('paciente.listagem', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paciente.cadastro');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePacienteRequest $request)
    {
        DB::beginTransaction();

        try {
            $paciente = Paciente::create([
                'nome' => $request->paciente_nome,
                'cpf' => $request->paciente_cpf,
                'data_nascimento' => $request->paciente_data_nascimento,
                'endereco_completo' => $request->paciente_endereco,
                'cep' => $request->paciente_cep,
            ]);

            Responsavel::create([
                'paciente_id' => $paciente->id,
                'nome' => $request->paciente_primeiro_responsavel_nome,
                'cpf' => $request->paciente_primeiro_responsavel_cpf,
                'grau_parentesco' => $request->paciente_primeiro_responsavel_parentesco,
            ]);

            Responsavel::create([
                'paciente_id' => $paciente->id,
                'nome' => $request->paciente_segundo_responsavel_nome,
                'cpf' => $request->paciente_segundo_responsavel_cpf,
                'grau_parentesco' => $request->paciente_segundo_responsavel_parentesco,
            ]);

            DB::commit();

            return redirect()->route('paciente.index')
                            ->with('success', 'Paciente e responsáveis cadastrados com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Erro ao cadastrar: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        return view('paciente.editar', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
            UpdatePacienteRequest $request, 
            Paciente $paciente
        )
    {
        DB::beginTransaction();

        try{
            $paciente->update([
                'nome' => $request->paciente_nome,
                'cpf' => $request->paciente_cpf,
                'data_nascimento' => $request->paciente_data_nascimento,
                'endereco_completo' => $request->paciente_endereco,
                'cep' => $request->paciente_cep
            ]);

            $responsaveis = $paciente->responsaveis;

            $responsaveis[0]->update([
                'nome' => $request->paciente_primeiro_responsavel_nome,
                'cpf' => $request->paciente_primeiro_responsavel_cpf,
                'grau_parentesco' => $request->paciente_primeiro_responsavel_parentesco,
            ]);

            $responsaveis[1]->update([
                'nome' => $request->paciente_segundo_responsavel_nome,
                'cpf' => $request->paciente_segundo_responsavel_cpf,
                'grau_parentesco' => $request->paciente_segundo_responsavel_parentesco,
            ]);

            DB::commit();

            return redirect()->route('paciente.index')
                ->with('success', 'Paciente atualizado com sucesso!');
        }catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Erro ao atualizar: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {

        DB::beginTransaction();

        try {
            $paciente->responsaveis()->delete();

            $paciente->delete();

            DB::commit();

            return redirect()->route('paciente.index')
                ->with('success', 'Paciente excluído com sucesso!');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withErrors(['error' => 'Erro ao excluir: ' . $e->getMessage()]);
        }
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');

        $pacientes = Paciente::with('responsaveis')
            ->where('nome', 'like', "%{$query}%")
            ->orWhere('cpf', 'like', "%{$query}%")
            ->limit(20)
            ->get();

        return $pacientes->map(function ($p) {
            return [
                'id' => $p->id,
                'label' => "{$p->nome} - {$p->cpf_formatado}",
                'data_nascimento' => $p->data_nascimento,
                'idade' => $p->idade_calculada,
                'cidade' => $p->endereco_completo,
                'cep' => $p->cep,
                'responsaveis' => $p->responsaveis->map(fn ($r) => [
                    'nome' => $r->nome,
                    'grau_parentesco' => $r->grau_parentesco
                ])
            ];
        });
    }
}
