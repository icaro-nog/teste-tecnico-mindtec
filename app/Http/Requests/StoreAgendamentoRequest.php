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
            'paciente_nome_cpf' => 'required|string|max:255',
            'medico_nome_crm' => 'required|string|max:255',
            'agendamento_data_hora' => 'date|required',
            'agendamento_status' => 'required|in:1,2,3',
        ];
    }

    public function messages(): array
    {
        return [
            'paciente_nome_cpf.required' => 'O campo Paciente é obrigatório.',
            'paciente_nome_cpf.string' => 'O campo Paciente deve conter texto.',
            'paciente_nome_cpf.max' => 'O nome ou CPF do paciente não pode ultrapassar 255 caracteres.',

            'medico_nome_crm.required' => 'O campo Médico é obrigatório.',
            'medico_nome_crm.string' => 'O campo Médico deve conter texto.',
            'medico_nome_crm.max' => 'O nome ou CRM do médico não pode ultrapassar 255 caracteres.',

            'agendamento_data_hora.required' => 'O campo Data é obrigatório.',
            'agendamento_data_hora.date' => 'O campo Data deve conter uma data válida.',

            'agendamento_status.required' => 'O campo Status é obrigatório.',
            'agendamento_status.in' => 'O campo Status deve ser Agendado, Cancelado ou Realizado.',
        ];
    }
}
