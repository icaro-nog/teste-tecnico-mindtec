document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('medico_nome_crm');
    const list = document.getElementById('autocomplete-medicos');

    const crmField = document.getElementById('medico_crm');
    const especialidadeField = document.getElementById('medico_especialidade');
    const cidadeField = document.getElementById('medico_cidade');
    const ufField = document.getElementById('medico_uf');

    let lastSelectedLabel = '';

    input.addEventListener('input', function () {
        const query = this.value.trim().toLowerCase();

        if (query.length < 2) {
            list.innerHTML = '';
            list.classList.add('hidden');
            clearFields();
            return;
        }

        if (query !== lastSelectedLabel) {
            clearFields();
        }

        fetch('/api/medicos')
            .then(res => res.json())
            .then(data => {
                
                // console.log(data)

                const matches = data.filter(medico =>
                    medico.nome.toLowerCase().includes(query) ||
                    medico.crm.toLowerCase().includes(query)
                );

                list.innerHTML = '';
                if (matches.length === 0) {
                    list.classList.add('hidden');
                    return;
                }

                matches.forEach(medico => {
                    const item = document.createElement('li');
                    item.className = 'px-3 py-2 hover:bg-gray-100 cursor-pointer';
                    item.textContent = `${medico.nome} (${medico.crm})`;

                    item.addEventListener('click', () => {
                        input.value = `${medico.nome} (${medico.crm})`;
                        lastSelectedLabel = input.value;

                        crmField.value = medico.crm;
                        especialidadeField.value = medico.especialidade;

                        if (medico.cep) {
                            fetch(`https://viacep.com.br/ws/${medico.cep.replace(/\D/g, '')}/json/`)
                                .then(res => res.json())
                                .then(viaCep => {
                                    cidadeField.value = viaCep.localidade || '';
                                    ufField.value = viaCep.uf || '';
                                })
                                .catch(() => {
                                    cidadeField.value = '';
                                });
                        }

                        list.classList.add('hidden');
                    });

                    list.appendChild(item);
                });

                list.classList.remove('hidden');
            });
    });

    // Oculta ao clicar fora
    document.addEventListener('click', function (e) {
        if (!document.getElementById('medico_nome_crm').contains(e.target)) {
            list.classList.add('hidden');
        }
    });

    function clearFields() {
        crmField.value = '';
        especialidadeField.value = '';
        cidadeField.value = '';
        ufField.value = '';
    }
});