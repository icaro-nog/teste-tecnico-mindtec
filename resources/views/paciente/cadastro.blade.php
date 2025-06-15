<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Paciente</title>
    @vite('resources/css/app.css')
    @vite('resources/js/paciente/cadastro.js')
</head>
<body class="bg-[#eff5f5] text-[#1a3544] font-sans">

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
        <h1 class="text-2xl font-bold mb-6">Cadastrar Paciente</h1>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form 
            action="{{ route('paciente.store') }}" 
            method="POST" class="space-y-6"
        >
            @csrf

            <div>
                <label for="paciente_nome" class="block font-medium mb-1">Nome</label>
                <input type="text" name="paciente_nome" id="paciente_nome"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                       value="{{ old('paciente_nome') }}">
            </div>

            <div>
                <label for="paciente_cpf" class="block font-medium mb-1">CPF</label>
                <input type="text" name="paciente_cpf" id="paciente_cpf"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440] cpf-mask"
                       value="{{ old('paciente_cpf') }}">
            </div>

            <div class="flex flex-wrap gap-6">
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_data_nascimento" class="block font-medium mb-1">Data de Nascimento</label>
                    <input type="date" name="paciente_data_nascimento" id="paciente_data_nascimento"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('paciente_data_nascimento') }}"
                           max="{{ date('Y-m-d') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_idade" class="block font-medium mb-1">Idade</label>
                    <input type="text" name="paciente_idade" id="paciente_idade" readonly
                           class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                           value="{{ old('paciente_idade') }}">
                </div>
            </div>

            <div>
                <label for="paciente_cep" class="block font-medium mb-1">CEP</label>
                <input type="text" name="paciente_cep" id="paciente_cep"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                    maxlength="9" placeholder="00000-000"
                    value="{{ old('paciente_cep') }}">
            </div>

            <div>
                <label for="paciente_endereco" class="block font-medium mb-1">Endereço</label>
                <input type="text" name="paciente_endereco" id="paciente_endereco"
                    class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                    value="{{ old('paciente_endereco') }}"
                    readonly>
            </div>

            {{-- resp 1 --}}
            <h2 class="text-xl font-semibold mt-4">Responsável 1</h2>
            <div class="flex flex-wrap gap-6">
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_primeiro_responsavel_nome" class="block font-medium mb-1">Nome</label>
                    <input type="text" name="paciente_primeiro_responsavel_nome" id="paciente_primeiro_responsavel_nome"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('paciente_primeiro_responsavel_nome') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_primeiro_responsavel_cpf" class="block font-medium mb-1">CPF</label>
                    <input type="text" name="paciente_primeiro_responsavel_cpf" id="paciente_primeiro_responsavel_cpf"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440] cpf-mask"
                           value="{{ old('paciente_primeiro_responsavel_cpf') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_primeiro_responsavel_parentesco" class="block font-medium mb-1">Grau de Parentesco</label>
                    <input type="text" name="paciente_primeiro_responsavel_parentesco" id="paciente_primeiro_responsavel_parentesco"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('paciente_primeiro_responsavel_parentesco') }}">
                </div>
            </div>

            {{-- resp 2 --}}
            <h2 class="text-xl font-semibold mt-6">Responsável 2</h2>
            <div class="flex flex-wrap gap-6">
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_segundo_responsavel_nome" class="block font-medium mb-1">Nome</label>
                    <input type="text" name="paciente_segundo_responsavel_nome" id="paciente_segundo_responsavel_nome"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('paciente_segundo_responsavel_nome') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_segundo_responsavel_cpf" class="block font-medium mb-1">CPF</label>
                    <input type="text" name="paciente_segundo_responsavel_cpf" id="paciente_segundo_responsavel_cpf"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440] cpf-mask"
                           value="{{ old('paciente_segundo_responsavel_cpf') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="paciente_segundo_responsavel_parentesco" class="block font-medium mb-1">Grau de Parentesco</label>
                    <input type="text" name="paciente_segundo_responsavel_parentesco" id="paciente_segundo_responsavel_parentesco"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('paciente_segundo_responsavel_parentesco') }}">
                </div>
            </div>

            <div>
                <button type="submit"
                        class="mt-6 bg-[#1a3544] text-[#eff5f5] font-semibold px-6 py-2 rounded hover:bg-[#76b030] transition">
                    Cadastrar
                </button>
            </div>
        </form>
    </main>

</body>
</html>