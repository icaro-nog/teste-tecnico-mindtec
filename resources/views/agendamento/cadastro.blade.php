<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <a href="{{ route('agendamento.index') }}">Listagem agendamentos</a>

    <br>

    <h2>Novo agendamento</h2>

    @if($errors->any())
            @foreach ($errors->all() as $error)
                <p 
                    style="color: #f00"
                >
                    {{ $error }}
                </p>
            @endforeach
    @endif

    <form 
        action="{{ route('agendamento-store') }}" 
        method="POST"
    >
        @csrf

        <label 
            for="paciente_nome_cpf"
        >Paciente</label>
        <input 
            type="text" 
            name="paciente_nome_cpf" 
            id="paciente_nome_cpf"
            placeholder="Nome ou CPF do paciente"
        >

        <br><br>

        Dados do paciente:

        <br><br>

        Data nascimento
        <input 
            type="date" 
            name="paciente_data_nascimento" 
            id="paciente_data_nascimento"
            readonly
        >

        Idade
        <input 
            type="number" 
            name="paciente_idade" 
            id="paciente_idade"
            readonly
        >

        Cidade
        <input 
            type="text" 
            name="paciente_cidade" 
            id="paciente_endereco"
            readonly
        >
        
        Responsáveis paciente
        <input 
            type="text" 
            name="paciente_primeiro_responsavel" 
            id="paciente_primeiro_responsavel"
            readonly
        >
        <input 
            type="text" 
            name="paciente_segundo_responsavel" 
            id="paciente_segundo_responsavel"
            readonly
        >

        <br><br>

        {{-- liberar aqui só quando for selecionado o paciente? --}}
        <label 
            for="medico_nome_crm"
        >Médico</label>
        <input 
            type="text"
            name="medico_nome_crm" 
            id="medico_nome_crm"
            placeholder="Nome ou CRM do médico"
        >

        <br><br>

        <label 
            for="medico_especialidade"
        >Especialidade do médico</label>
        <input 
            type="text" 
            name="medico_especialidade" 
            id="medico_especialidade"
            readonly
        >

        <br><br>

        <label 
            for="agendamento_data_hora"
        >Data</label>
        <input 
            type="datetime-local" 
            name="agendamento_data_hora" 
            id="agendamento_data_hora"
        >

        <br><br>

        <label 
            for="agendamento_status"
        >Status</label>
        <select 
            name="agendamento_status" 
            id="agendamento_status"
        >
            <option value="1">Agendado</option>
            <option value="2">Cancelado</option>
            <option value="3">Realizado</option>
        </select>

        <br><br>

        <button 
            type="submit"
        >
        Cadastrar
        </button>

    </form>
</body>
</html>