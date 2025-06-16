document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('paciente_nome_cpf');
    const list = document.getElementById('autocomplete-list');
    const hiddenInput = document.getElementById('paciente_id');
    const inputMedico = document.getElementById('medico_nome_crm');
    liberarInputMedico(false);

    let lastSelectedLabel = '';

    input.addEventListener('input', function () {
        const query = this.value;

        if (query.trim() === '') {
            clearPacienteData();
            liberarInputMedico(false);
            return;
        }

        if (query !== lastSelectedLabel) {
            hiddenInput.value = '';
            clearPacienteData();
            liberarInputMedico(false);
        }

        if (query.length < 2) {
            list.style.display = 'none';
            return;
        }

        fetch(`/autocomplete/paciente?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                list.innerHTML = '';
                if (data.length === 0) {
                    list.style.display = 'none';
                    return;
                }

                data.forEach(paciente => {
                    const item = document.createElement('li');
                    item.textContent = paciente.label;
                    item.className = 'px-3 py-2 hover:bg-gray-100 cursor-pointer';
                    item.addEventListener('click', function () {
                        input.value = paciente.label;
                        hiddenInput.value = paciente.id;
                        lastSelectedLabel = paciente.label;

                        preencherCampos(paciente);
                        liberarInputMedico(true);
                        list.style.display = 'none';
                    });
                    list.appendChild(item);
                });

                list.style.display = 'block';
            });
    });

    document.addEventListener('click', function (e) {
        if (!document.querySelector('.autocomplete-wrapper').contains(e.target)) {
            list.style.display = 'none';
        }
    });

    function preencherCampos(p) {
        document.getElementById('paciente_data_nascimento').value = p.data_nascimento || '';
        document.getElementById('paciente_idade').value = p.idade || '';
        document.getElementById('paciente_endereco').value = p.cidade || '';
        document.getElementById('paciente_cep').value = p.cep || '';

        const r1 = p.responsaveis[0] || {};
        const r2 = p.responsaveis[1] || {};

        document.getElementById('paciente_primeiro_responsavel').value = r1.nome || '';
        document.getElementById('paciente_grau_parentesco_primeiro_responsavel').value = r1.grau_parentesco || '';

        document.getElementById('paciente_segundo_responsavel').value = r2.nome || '';
        document.getElementById('paciente_grau_parentesco_segundo_responsavel').value = r2.grau_parentesco || '';
    }

    function liberarInputMedico(pacientePreenchido){
        inputMedico.disabled = !pacientePreenchido;
    }

    function clearPacienteData() {
        hiddenInput.value = '';
        document.getElementById('paciente_data_nascimento').value = '';
        document.getElementById('paciente_idade').value = '';
        document.getElementById('paciente_endereco').value = '';
        document.getElementById('paciente_cep').value = '';

        document.getElementById('paciente_primeiro_responsavel').value = '';
        document.getElementById('paciente_grau_parentesco_primeiro_responsavel').value = '';

        document.getElementById('paciente_segundo_responsavel').value = '';
        document.getElementById('paciente_grau_parentesco_segundo_responsavel').value = '';
    }
});