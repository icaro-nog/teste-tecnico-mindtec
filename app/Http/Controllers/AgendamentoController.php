<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgendamentoRequest;
use App\Http\Requests\UpdateAgendamentoRequest;
use App\Models\Agendamento;
use Illuminate\Support\Facades\DB;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendamentos = Agendamento::with(['paciente.responsaveis'])->get();
        return view('agendamento.index', compact('agendamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agendamento.cadastro');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgendamentoRequest $request)
    {
        DB::beginTransaction();

        try {
            $agendamentosPaciente = Agendamento::where('paciente_id', $request->paciente_id)->count();

            if ($agendamentosPaciente >= 3) {
                // withError não funcionou
                return view('agendamento.cadastro', [
                    'erro_limite_agendamento' => 'O paciente já atingiu o máximo de 3 agendamentos!',
                ]);
            }

            Agendamento::create([
                'paciente_id'      => $request->paciente_id,
                'nome_medico'      => $request->medico_nome_crm,
                'crm_medico'       => $request->medico_crm,
                'cidade_medico'    => $request->medico_cidade,
                'uf_medico'        => $request->medico_uf,
                'especialidade'    => $request->medico_especialidade,
                'data_hora'        => $request->agendamento_data_hora,
                'status'           => $request->agendamento_status,
            ]);

            DB::commit();

            return redirect()->route('agendamento.index')
                ->with('success', 'Agendamento cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro ao cadastrar: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Agendamento $agendamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agendamento $agendamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendamentoRequest $request, Agendamento $agendamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agendamento $agendamento)
    {
        //
    }
}
