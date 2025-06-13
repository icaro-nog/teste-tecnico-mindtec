<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Paciente</title>
    @vite('resources/css/app.css')
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
        <h1 class="text-2xl font-bold mb-6">Cadastrar Paciente</h1>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form 
        {{-- action="{{ route('paciente.store') }}"  --}}
        method="POST" class="space-y-6">
            @csrf

            {{-- Nome --}}
            <div>
                <label for="nome" class="block font-medium mb-1">Nome</label>
                <input type="text" name="nome" id="nome"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                       value="{{ old('nome') }}">
            </div>

            {{-- CPF --}}
            <div>
                <label for="cpf" class="block font-medium mb-1">CPF</label>
                <input type="text" name="cpf" id="cpf"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                       value="{{ old('cpf') }}">
            </div>

            {{-- Data de nascimento e Idade --}}
            <div class="flex flex-wrap gap-6">
                <div class="flex-1 min-w-[200px]">
                    <label for="data_nascimento" class="block font-medium mb-1">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('data_nascimento') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="idade" class="block font-medium mb-1">Idade</label>
                    <input type="number" name="idade" id="idade" readonly
                           class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                           value="{{ old('idade') }}">
                </div>
            </div>

            {{-- Endereço --}}
            <div>
                <label for="endereco" class="block font-medium mb-1">Endereço</label>
                <input type="text" name="endereco" id="endereco"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                       value="{{ old('endereco') }}">
            </div>

            {{-- Responsável 1 --}}
            <h2 class="text-xl font-semibold mt-4">Responsável 1</h2>
            <div class="flex flex-wrap gap-6">
                <div class="flex-1 min-w-[200px]">
                    <label for="responsavel1_nome" class="block font-medium mb-1">Nome</label>
                    <input type="text" name="responsavel1_nome" id="responsavel1_nome"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('responsavel1_nome') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="responsavel1_cpf" class="block font-medium mb-1">CPF</label>
                    <input type="text" name="responsavel1_cpf" id="responsavel1_cpf"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('responsavel1_cpf') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="responsavel1_parentesco" class="block font-medium mb-1">Grau de Parentesco</label>
                    <input type="text" name="responsavel1_parentesco" id="responsavel1_parentesco"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('responsavel1_parentesco') }}">
                </div>
            </div>

            {{-- Responsável 2 --}}
            <h2 class="text-xl font-semibold mt-6">Responsável 2</h2>
            <div class="flex flex-wrap gap-6">
                <div class="flex-1 min-w-[200px]">
                    <label for="responsavel2_nome" class="block font-medium mb-1">Nome</label>
                    <input type="text" name="responsavel2_nome" id="responsavel2_nome"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('responsavel2_nome') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="responsavel2_cpf" class="block font-medium mb-1">CPF</label>
                    <input type="text" name="responsavel2_cpf" id="responsavel2_cpf"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('responsavel2_cpf') }}">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="responsavel2_parentesco" class="block font-medium mb-1">Grau de Parentesco</label>
                    <input type="text" name="responsavel2_parentesco" id="responsavel2_parentesco"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#86c440]"
                           value="{{ old('responsavel2_parentesco') }}">
                </div>
            </div>

            {{-- Botão --}}
            <div>
                <button type="submit"
                        class="mt-6 bg-[#86c440] text-[#1a3544] font-semibold px-6 py-2 rounded hover:bg-[#76b030] transition">
                    Cadastrar Paciente
                </button>
            </div>
        </form>
    </main>

</body>
</html>