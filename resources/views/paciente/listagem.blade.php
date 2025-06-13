<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Pacientes</title>
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

    <main class="p-6">
        <h1 class="text-2xl font-bold mb-6">Lista de Pacientes</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded overflow-hidden">
                <thead class="bg-[#d4e3e3] text-[#1a3544]">
                    <tr>
                        <th class="text-left px-4 py-3">ID</th>
                        <th class="text-left px-4 py-3">Nome</th>
                        <th class="text-left px-4 py-3">CPF</th>
                        <th class="text-left px-4 py-3">Nascimento</th>
                        <th class="text-left px-4 py-3">Idade</th>
                        <th class="text-left px-4 py-3">Endereço</th>
                        <th class="text-left px-4 py-3">Responsáveis</th>
                        <th class="text-left px-4 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#d4e3e3]">
                    {{-- @forelse($pacientes as $paciente)
                        <tr class="hover:bg-[#f1f8f8]">
                            <td class="px-4 py-3">{{ $paciente->id }}</td>
                            <td class="px-4 py-3">{{ $paciente->nome }}</td>
                            <td class="px-4 py-3">{{ $paciente->cpf }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($paciente->data_nascimento)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($paciente->data_nascimento)->age }} anos</td>
                            <td class="px-4 py-3">
                                {{ $paciente->endereco }}, {{ $paciente->numero }} - {{ $paciente->bairro }},
                                {{ $paciente->cidade }} - {{ $paciente->estado }}, {{ $paciente->cep }}
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('paciente.edit', $paciente->id) }}"
                                   class="bg-[#86c440] text-[#1a3544] font-medium px-3 py-1.5 rounded hover:bg-[#76b030] transition">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center">Nenhum paciente encontrado.</td>
                        </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>