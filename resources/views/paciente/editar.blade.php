<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Paciente</title>
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
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Editar Paciente</h1>
            <a 
                href="{{ route('agendamento.export.csv', $paciente->id) }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Agendamentos CSV
            </a>
        </div>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="mt-6 space-y-4 w-full">

            <form 
                action="{{ route('paciente.update', $paciente->id) }}" 
                method="POST" 
                class="space-y-6"
            >
                @csrf
                @method('PUT')

                <div>
                    <label for="paciente_nome" class="block font-medium mb-1">Nome</label>
                    <input type="text" name="paciente_nome" id="paciente_nome" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]" value="{{ old('paciente_nome', $paciente->nome) }}">
                </div>

                <div>
                    <label for="paciente_cpf" class="block font-medium mb-1">CPF</label>
                    <input type="text" name="paciente_cpf" id="paciente_cpf" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440] cpf-mask" value="{{ old('paciente_cpf', $paciente->cpf) }}">
                </div>

                <div class="flex flex-wrap gap-6">
                    <div class="flex-1 min-w-[200px]">
                        <label for="paciente_data_nascimento" class="block font-medium mb-1">Data de Nascimento</label>
                        <input type="date" name="paciente_data_nascimento" id="paciente_data_nascimento"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                            value="{{ old('paciente_data_nascimento', $paciente->data_nascimento) }}"
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
                        value="{{ old('paciente_cep', $paciente->cep) }}">
                </div>

                <div>
                    <label for="paciente_endereco" class="block font-medium mb-1">Endereço</label>
                    <input type="text" name="paciente_endereco" id="paciente_endereco"
                        class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                        readonly
                        value="{{ old('paciente_endereco', $paciente->endereco_completo) }}">
                </div>

                {{-- resp 1 --}}
                <h2 class="text-xl font-semibold mt-4">Responsável 1</h2>
                <div class="flex flex-wrap gap-6">
                    <div class="flex-1 min-w-[200px]">
                        <label for="paciente_primeiro_responsavel_nome" class="block font-medium mb-1">Nome</label>
                        <input type="text" name="paciente_primeiro_responsavel_nome" id="paciente_primeiro_responsavel_nome"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                            value="{{ old('paciente_primeiro_responsavel_nome', $paciente->responsaveis[0]->nome) }}">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="paciente_primeiro_responsavel_cpf" class="block font-medium mb-1">CPF</label>
                        <input type="text" name="paciente_primeiro_responsavel_cpf" id="paciente_primeiro_responsavel_cpf"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440] cpf-mask"
                            value="{{ old('paciente_primeiro_responsavel_cpf', $paciente->responsaveis[0]->cpf) }}">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="paciente_primeiro_responsavel_parentesco" class="block font-medium mb-1">Grau de Parentesco</label>
                        <input type="text" name="paciente_primeiro_responsavel_parentesco" id="paciente_primeiro_responsavel_parentesco"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                            value="{{ old('paciente_primeiro_responsavel_parentesco', $paciente->responsaveis[0]->grau_parentesco) }}">
                    </div>
                </div>

                {{-- resp 2 --}}
                <h2 class="text-xl font-semibold mt-6">Responsável 2</h2>
                <div class="flex flex-wrap gap-6">
                    <div class="flex-1 min-w-[200px]">
                        <label for="paciente_segundo_responsavel_nome" class="block font-medium mb-1">Nome</label>
                        <input type="text" name="paciente_segundo_responsavel_nome" id="paciente_segundo_responsavel_nome"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                            value="{{ old('paciente_segundo_responsavel_nome', $paciente->responsaveis[1]->nome) }}">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="paciente_segundo_responsavel_cpf" class="block font-medium mb-1">CPF</label>
                        <input type="text" name="paciente_segundo_responsavel_cpf" id="paciente_segundo_responsavel_cpf"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440] cpf-mask"
                            value="{{ old('paciente_segundo_responsavel_cpf', $paciente->responsaveis[1]->cpf) }}">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="paciente_segundo_responsavel_parentesco" class="block font-medium mb-1">Grau de Parentesco</label>
                        <input type="text" name="paciente_segundo_responsavel_parentesco" id="paciente_segundo_responsavel_parentesco"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                            value="{{ old('paciente_segundo_responsavel_parentesco', $paciente->responsaveis[1]->grau_parentesco) }}">
                    </div>
                </div>
                
                <button type="submit" class="mt-6 w-48 bg-[#1a3544] text-[#eff5f5] font-semibold px-6 py-2 rounded hover:bg-[#76b030] transition">
                    Atualizar
                </button>
            </form>

            <form action="{{ route('paciente.destroy', $paciente->id) }}" method="POST" class="mt-4 w-full">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="bg-red-600 w-48 text-[#eff5f5] font-semibold px-6 py-2 rounded hover:bg-red-700 transition">
                    Deletar
                </button>
            </form>

        </div>

    </main>

</body>
</html>