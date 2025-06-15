<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
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
            'paciente_nome' => 'required|string|max:255',
            'paciente_cpf' => 'required|size:11|unique:pacientes,cpf',
            'paciente_data_nascimento' => [
                'required',
                'date',
                'before_or_equal:' . now()->toDateString(), // Não permitir data futura
            ],
            'paciente_endereco' => 'required|string|max:255',
            'paciente_cep' => 'required|size:8',

            'paciente_primeiro_responsavel_nome' => 'required|string|max:255',
            'paciente_primeiro_responsavel_cpf' => 'required|size:11|unique:responsaveis,cpf',
            'paciente_primeiro_responsavel_parentesco' => 'required|string|max:100',

            'paciente_segundo_responsavel_nome' => 'required|string|max:255',
            'paciente_segundo_responsavel_cpf' => 'required|size:11|unique:responsaveis,cpf',
            'paciente_segundo_responsavel_parentesco' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'paciente_nome.required' => 'O nome do paciente é obrigatório.',
            'paciente_nome.string' => 'Nome de paciente inválido.',
            'paciente_nome.max' => 'O nome do paciente não pode ter mais de 255 caracteres.',

            'paciente_cpf.required' => 'O CPF do paciente é obrigatório.',
            'paciente_cpf.size' => 'O CPF do paciente deve ter 11 caracteres.',
            'paciente_cpf.unique' => 'O CPF do paciente já está cadastrado.',

            'paciente_cep.required' => 'O CEP do paciente é obrigatório.',
            'paciente_cep.size' => 'O CEP do paciente deve ter 8 caracteres.',

            'paciente_data_nascimento.required' => 'A data de nascimento do paciente é obrigatória.',
            'paciente_data_nascimento.date' => 'A data de nascimento fornecida não é válida.',
            'paciente_data_nascimento.before_or_equal' => 'A data de nascimento não pode ser futura.',

            'paciente_endereco.required' => 'O endereço do paciente é obrigatório.',
            'paciente_endereco.string' => 'Endereço inválido.',
            'paciente_endereco.max' => 'O endereço do paciente não pode ter mais de 255 caracteres.',

            'paciente_primeiro_responsavel_nome.required' => 'O nome do primeiro responsável é obrigatório.',
            'paciente_primeiro_responsavel_nome.string' => 'Nome do primeiro responsável inválido.',
            'paciente_primeiro_responsavel_nome.max' => 'O nome do primeiro responsável não pode ter mais de 255 caracteres.',

            'paciente_primeiro_responsavel_cpf.required' => 'O CPF do primeiro responsável é obrigatório.',
            'paciente_primeiro_responsavel_cpf.size' => 'O CPF do primeiro responsável deve ter 11 caracteres.',
            'paciente_primeiro_responsavel_cpf.unique' => 'O CPF do primeiro responsável já está cadastrado.',

            'paciente_primeiro_responsavel_parentesco.required' => 'O grau de parentesco do primeiro responsável é obrigatório.',
            'paciente_primeiro_responsavel_parentesco.string' => 'Grau de parentesco do primeiro responsável inválido.',
            'paciente_primeiro_responsavel_parentesco.max' => 'O grau de parentesco não pode ter mais de 100 caracteres.',

            'paciente_segundo_responsavel_nome.required' => 'O nome do segundo responsável é obrigatório.',
            'paciente_segundo_responsavel_nome.string' => 'Nome do segundo responsável inválido.',
            'paciente_segundo_responsavel_nome.max' => 'O nome do segundo responsável não pode ter mais de 255 caracteres.',

            'paciente_segundo_responsavel_cpf.required' => 'O CPF do segundo responsável é obrigatório.',
            'paciente_segundo_responsavel_cpf.size' => 'O CPF do segundo responsável deve ter 11 caracteres.',
            'paciente_segundo_responsavel_cpf.unique' => 'O CPF do segundo responsável já está cadastrado.',

            'paciente_segundo_responsavel_parentesco.required' => 'O grau de parentesco do segundo responsável é obrigatório.',
            'paciente_segundo_responsavel_parentesco.string' => 'Grau de parentesco do segundo responsável inválido .',
            'paciente_segundo_responsavel_parentesco.max' => 'O grau de parentesco não pode ter mais de 100 caracteres.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $cpfPaciente = $this->input('paciente_cpf');
            $cpfResp1 = $this->input('paciente_primeiro_responsavel_cpf');
            $cpfResp2 = $this->input('paciente_segundo_responsavel_cpf');

            if ($cpfPaciente === $cpfResp1) {
                $validator->errors()->add('paciente_primeiro_responsavel_cpf', 'O CPF do primeiro responsável não pode ser igual ao CPF do paciente.');
            }

            if ($cpfPaciente === $cpfResp2) {
                $validator->errors()->add('paciente_segundo_responsavel_cpf', 'O CPF do segundo responsável não pode ser igual ao CPF do paciente.');
            }

            if ($cpfResp1 === $cpfResp2) {
                $validator->errors()->add('paciente_segundo_responsavel_cpf', 'O CPF do segundo responsável não pode ser igual ao do primeiro responsável.');
            }
        });
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'paciente_cpf' => preg_replace('/\D/', '', $this->paciente_cpf),
            'paciente_primeiro_responsavel_cpf' => preg_replace('/\D/', '', $this->paciente_primeiro_responsavel_cpf),
            'paciente_segundo_responsavel_cpf' => preg_replace('/\D/', '', $this->paciente_segundo_responsavel_cpf),
            'paciente_cep' => preg_replace('/\D/', '', $this->paciente_cep),
        ]);
    }
}
