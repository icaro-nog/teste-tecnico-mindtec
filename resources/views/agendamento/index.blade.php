<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Agendamentos</title>
    @vite(['resources/css/app.css', 'resources/js/agendamento/atualizaStatus.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <h1 class="text-2xl font-bold mb-6">Lista de Agendamentos</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded overflow-hidden">
                <thead class="bg-[#d4e3e3] text-[#1a3544]">
                    <tr>
                        <th class="text-left px-4 py-3">ID</th>
                        <th class="text-left px-4 py-3">Paciente</th>
                        <th class="text-left px-4 py-3">Responsáveis</th>
                        <th class="text-left px-4 py-3">Médico</th>
                        <th class="text-left px-4 py-3">Especialidade</th>
                        <th class="text-left px-4 py-3">Data e Hora</th>
                        <th class="text-left px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#d4e3e3]">
                    @forelse($agendamentos as $agendamento)
                        <tr class="hover:bg-[#f1f8f8]">
                            <td class="px-4 py-3">{{ $agendamento->id }}</td>
                            <td class="px-4 py-3">{{ $agendamento->paciente->nome }}</td>
                            <td class="px-4 py-3">
                                <ul class="list-disc ml-6 list-none">
                                    @foreach ($agendamento->paciente->responsaveis as $responsavel)
                                        <li>
                                            {{ $responsavel->nome }} ({{ $responsavel->grau_parentesco }})
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-4 py-3">{{ $agendamento->nome_medico }}</td>
                            <td class="px-4 py-3">{{ $agendamento->especialidade }}</td>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($agendamento->data_hora)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                <select class="status-select border rounded px-2 py-1"
                                        data-id="{{ $agendamento->id }}"
                                        data-data-hora="{{ $agendamento->data_hora }}"
                                        data-original="{{ $agendamento->status }}">
                                    <option value="1" {{ $agendamento->status == 1 ? 'selected' : '' }}>Agendado</option>
                                    <option value="2" {{ $agendamento->status == 2 ? 'selected' : '' }}>Cancelado</option>
                                    <option value="3" {{ $agendamento->status == 3 ? 'selected' : '' }}>Realizado</option>
                                </select>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center">Nenhum agendamento encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>