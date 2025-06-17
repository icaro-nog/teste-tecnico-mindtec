<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgendamentoRequest;
use App\Http\Requests\UpdateAgendamentoRequest;
use App\Models\Agendamento;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function atualizarStatus(Request $request, $id)
    {
        $agendamento = Agendamento::findOrFail($id);

        $request->validate([
            'status' => 'required|in:1,2,3',
        ]);

        if ($request->status == 2 && now()->diffInHours($agendamento->data_hora, false) < 12) {
            return response()->json([
                'success' => false,
                'message' => 'Cancelamento só é permitido até 12h antes do agendamento.'
            ], 400);
        }

        $agendamento->status = $request->status;
        $agendamento->save();

        return response()->json(['success' => true]);
    }

    public function exportCsv($pacienteId): StreamedResponse
    {
        $paciente = Paciente::findOrFail($pacienteId);

        $agendamentos = $paciente->agendamentos()->with(['paciente.responsaveis'])->get();

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=agendamentos_paciente_{$paciente->id}.csv",
        ];

        $columns = [
            'ID', 
            'Paciente',
            'Responsável 1',
            'Responsável 2',
            'Médico',
            'Especialidade',
            'Data e Hora',
            'Status'
        ];

        $callback = function () use ($agendamentos, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($agendamentos as $agendamento) {

                $statusAgendamento = '';

                switch($agendamento->status){
                    case 1: 
                        $statusAgendamento = 'Agendado';
                        break;
                    case 2: 
                        $statusAgendamento = 'Cancelado';
                        break;
                    case 3: 
                        $statusAgendamento = 'Realizado';
                        break;
                }

                fputcsv($handle, [
                    $agendamento->id,
                    $agendamento->paciente->nome,
                    $agendamento->paciente->responsaveis[0]->nome . ' (' . $agendamento->paciente->responsaveis[0]->grau_parentesco . ') - ' . $agendamento->paciente->responsaveis[0]->cpf,
                    $agendamento->paciente->responsaveis[1]->nome . ' (' . $agendamento->paciente->responsaveis[1]->grau_parentesco . ') - ' . $agendamento->paciente->responsaveis[1]->cpf,
                    $agendamento->nome_medico,
                    $agendamento->especialidade,
                    $agendamento->data_hora,
                    $statusAgendamento
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
