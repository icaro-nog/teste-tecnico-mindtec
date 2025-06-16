<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgendamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_nome_crm' => 'required|string|max:255',
            'medico_crm' => 'required|string|max:9',
            'medico_cidade' => 'required|string|max:100',
            'medico_uf' => 'required|string|size:2',
            'medico_especialidade' => 'required|string|max:255',
            'agendamento_data_hora' => 'required|date',
            'agendamento_status' => 'required|in:1,2,3',
        ];
    }

    public function messages(): array
    {
        return [
            'paciente_id.required' => 'O campo Paciente é obrigatório.',

            'medico_nome_crm.required' => 'O campo Médico é obrigatório.',
            'medico_nome_crm.string' => 'O campo Médico deve conter texto.',
            'medico_nome_crm.max' => 'O nome ou CRM do médico não pode ultrapassar 255 caracteres.',

            'medico_crm.required' => 'O número do CRM do médico é obrigatório.',
            'medico_crm.string' => 'O CRM do médico deve ser um texto válido.',
            'medico_crm.max' => 'O CRM do médico não pode ter mais de 9 caracteres.',

            'medico_cidade.required' => 'A cidade do médico é obrigatória.',
            'medico_cidade.string' => 'A cidade do médico deve ser um texto válido.',
            'medico_cidade.max' => 'A cidade do médico não pode ter mais de 100 caracteres.',

            'medico_uf.required' => 'O campo UF do médico é obrigatório.',
            'medico_uf.string' => 'A UF do médico deve ser um texto válido.',
            'medico_uf.size' => 'A UF do médico deve conter exatamente 2 letras (ex: SP, RJ).',

            'medico_especialidade.required' => 'A especialidade do médico é obrigatória.',
            'medico_especialidade.string' => 'A especialidade do médico deve ser um texto válido.',
            'medico_especialidade.max' => 'A especialidade do médico não pode ter mais de 255 caracteres.',

            'agendamento_data_hora.required' => 'A data e hora do agendamento são obrigatórias.',
            'agendamento_data_hora.date' => 'Informe uma data e hora válidas para o agendamento.',

            'agendamento_status.required' => 'O status do agendamento é obrigatório.',
            'agendamento_status.in' => 'O status selecionado é inválido. Escolha entre Agendado, Cancelado ou Realizado.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'medico_crm' => preg_replace('/\D/', '', $this->medico_crm)
        ]);
    }
}
