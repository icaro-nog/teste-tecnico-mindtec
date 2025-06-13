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
            'paciente_nome_cpf' => 'required',
            'medico_nome_crm' => 'required',
            'agendamento_data_hora' => 'required',
            'agendamento_status' => 'between:1,3'
        ];
    }

    public function messages(): array
    {
        return [
            'paciente_nome_cpf.required' => 'Atenção! O campo Paciente é obrigatório!',
            'agendamento_data_hora.required' => 'Atenção! O campo Data é obrigatório!',
            'agendamento_data_hora.date_format' => 'Atenção! O campo Data deve ser preenchido com uma data válida!',
            'agendamento_status.between' => 'Atenção! o campo Status deve ser preenchido com: Agendado, Cancelado ou Realizado!',
        ];
    }
}
