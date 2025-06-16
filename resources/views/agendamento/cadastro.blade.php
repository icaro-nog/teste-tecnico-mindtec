<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Agendamento</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#eff5f5] text-[#1a3544] font-sans">

    {{-- Menu de navegação --}}
    <nav class="flex flex-wrap items-center justify-center gap-4 p-4 bg-white shadow-md">
        <a href="{{ route('agendamento.index') }}"
           class="bg-[#86c440] text-[#1a3544] font-semibold px-4 py-2 rounded hover:bg-[#76b030] transition">
            Agendamentos
        </a>
        <a href="{{ route('agendamento.create') }}"
           class="bg-[#86c440] text-[#1a3544] font-semibold px-4 py-2 rounded hover:bg-[#76b030] transition">
            Novo Agendamento
        </a>
        <a href="{{ route('paciente.index') }}"
           class="bg-[#86c440] text-[#1a3544] font-semibold px-4 py-2 rounded hover:bg-[#76b030] transition">
            Pacientes
        </a>
        <a href="{{ route('paciente.create') }}"
           class="bg-[#86c440] text-[#1a3544] font-semibold px-4 py-2 rounded hover:bg-[#76b030] transition">
            Cadastrar Paciente
        </a>
    </nav>

    <main class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold mb-6">Novo Agendamento</h2>

        {{-- erros --}}
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(isset($erro_limite_agendamento))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <p>{{ $erro_limite_agendamento }}</p>
            </div>
        @endif

        <form action="{{ route('agendamento.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="autocomplete-wrapper" style="position: relative;">
                <label for="paciente_nome_cpf" class="block font-medium mb-1">Paciente</label>
                <input type="text" name="paciente_nome_cpf" id="paciente_nome_cpf"
                    placeholder="Nome ou CPF do paciente"
                    autocomplete="off"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                    value="{{ old('paciente_nome_cpf') }}">

                <input type="hidden" name="paciente_id" id="paciente_id" value="{{ old('paciente_id') }}">
                <input type="hidden" name="paciente_cep" id="paciente_cep" value="{{ old('paciente_cep') }}">

                <!-- Lista de pacientes -->
                <ul id="autocomplete-list" class="absolute bg-white border border-gray-300 w-full mt-1 z-10 rounded shadow"
                    style="display: none;"></ul>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="paciente_data_nascimento" class="block font-medium mb-1">Data de Nascimento</label>
                    <input type="date" name="paciente_data_nascimento" id="paciente_data_nascimento"
                           readonly
                           class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                           value="{{ old('paciente_data_nascimento') }}">
                </div>

                <div>
                    <label for="paciente_idade" class="block font-medium mb-1">Idade</label>
                    <input type="text" name="paciente_idade" id="paciente_idade"
                           readonly
                           class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                           value="{{ old('paciente_idade') }}">
                </div>
            </div>

            <div>
                <label for="paciente_endereco" class="block font-medium mb-1">Endereço</label>
                <input type="text" name="paciente_endereco" id="paciente_endereco"
                       readonly
                       class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                       value="{{ old('paciente_endereco') }}">
            </div>

            <div class="flex flex-wrap gap-6">
                
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_primeiro_responsavel" class="block font-medium mb-1">Responsável 1</label>
                    <input type="text" name="paciente_primeiro_responsavel" id="paciente_primeiro_responsavel"
                        readonly
                        class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                        value="{{ old('paciente_primeiro_responsavel') }}">
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_grau_parentesco_primeiro_responsavel" class="block font-medium mb-1">Grau de parentesco</label>
                    <input type="text" name="paciente_grau_parentesco_primeiro_responsavel" id="paciente_grau_parentesco_primeiro_responsavel"
                        readonly
                        class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                        value="{{ old('paciente_grau_parentesco_primeiro_responsavel') }}">
                </div>
            </div>
            
            <div class="flex flex-wrap gap-6">
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_segundo_responsavel" class="block font-medium mb-1">Responsável 2</label>
                    <input type="text" name="paciente_segundo_responsavel" id="paciente_segundo_responsavel"
                        readonly
                        class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                        value="{{ old('paciente_segundo_responsavel') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_grau_parentesco_segundo_responsavel" class="block font-medium mb-1">Grau de parentesco</label>
                    <input type="text" name="paciente_grau_parentesco_segundo_responsavel" id="paciente_grau_parentesco_segundo_responsavel"
                        readonly
                        class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                        value="{{ old('paciente_grau_parentesco_segundo_responsavel') }}">
                </div>
            </div>

            <div class="flex flex-wrap gap-4">
                <div class="flex-auto w-95" style="position: relative;">
                    <label for="medico_nome_crm" class="block font-medium mb-1">Médico</label>
                    <input type="text" name="medico_nome_crm" id="medico_nome_crm"
                           placeholder="Nome ou CRM do médico"
                           value="{{ old('medico_nome_crm') }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           autocomplete="off">

                    <!-- Lista de pacientes -->
                    <ul id="autocomplete-medicos" class="absolute bg-white w-full border border-gray-200 shadow-md rounded mt-1 z-10 hidden"></ul>
                </div>

                <div class="flex-auto w-5">
                    <label for="medico_crm" class="block font-medium mb-1">CRM</label>
                    <input type="text" name="medico_crm" id="medico_crm"
                           value="{{ old('medico_crm') }}"
                           readonly
                           class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
                </div>
            </div>

            <div class="flex flex-wrap gap-4">
                <div class="flex-auto w-95">
                    <label for="medico_cidade" class="block font-medium mb-1">Cidade do Médico</label>
                    <input type="text" name="medico_cidade" id="medico_cidade"
                           readonly
                           value="{{ old('medico_cidade') }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
                </div>

                <div class="flex-auto w-5">
                    <label for="medico_uf" class="block font-medium mb-1">UF</label>
                    <input type="text" name="medico_uf" id="medico_uf"
                           value="{{ old('medico_uf') }}"
                           readonly
                           class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
                </div>
            </div>

            <div>
                <label for="medico_especialidade" class="block font-medium mb-1">Especialidade do Médico</label>
                <input type="text" name="medico_especialidade" id="medico_especialidade"
                       readonly
                       class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                       value="{{ old('medico_especialidade') }}">
            </div>

            <div>
                <label for="agendamento_data_hora" class="block font-medium mb-1">Data e Hora</label>
                <input type="datetime-local" name="agendamento_data_hora" id="agendamento_data_hora"
                       value="{{ old('agendamento_data_hora') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]">
            </div>

            <div>
                <label for="agendamento_status" class="block font-medium mb-1">Status</label>
                <select name="agendamento_status" id="agendamento_status"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]">
                    <option value="1" {{ old('agendamento_status') == 1 ? 'selected' : '' }}>Agendado</option>
                    <option value="2" {{ old('agendamento_status') == 2 ? 'selected' : '' }}>Cancelado</option>
                    <option value="3" {{ old('agendamento_status') == 3 ? 'selected' : '' }}>Realizado</option>
                </select>
            </div>

            <div>
                <button type="submit"
                        class="bg-[#1a3544] text-[#eff5f5] font-semibold px-6 py-2 rounded hover:bg-[#76b030] transition">
                    Cadastrar
                </button>
            </div>
        </form>
    </main>

</body>
</html>