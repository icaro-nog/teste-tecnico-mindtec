import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

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

                        if (medico.cep) {
                            const cepMedico = medico.cep.replace(/\D/g, '');
                            const cepPaciente = document.getElementById('paciente_cep')?.value?.replace(/\D/g, '');

                            // Buscar dados do médico
                            fetch(`https://viacep.com.br/ws/${cepMedico}/json/`)
                                .then(res => res.json())
                                .then(viaCepMedico => {

                                    // Buscar dados do paciente
                                    fetch(`https://viacep.com.br/ws/${cepPaciente}/json/`)
                                        .then(res => res.json())
                                        .then(viaCepPaciente => {

                                            const mesmaCidade = (
                                                viaCepMedico.localidade === viaCepPaciente.localidade &&
                                                viaCepMedico.uf === viaCepPaciente.uf
                                            );

                                            if (!mesmaCidade) {
                                                Toastify({
                                                    text: "Atenção! Médico indisponível para a cidade do paciente.",
                                                    duration: 4000,
                                                    gravity: "top", 
                                                    position: "right",
                                                    backgroundColor: "#dc2626",
                                                    stopOnFocus: true,
                                                }).showToast();
                                            } else {
                                                // Segue o fluxo normal
                                                lastSelectedLabel = input.value;

                                                crmField.value = medico.crm;
                                                especialidadeField.value = medico.especialidade;

                                                cidadeField.value = viaCepMedico.localidade || '';
                                                ufField.value = viaCepMedico.uf || '';
                                            }

                                        })
                                        .catch(() => {
                                            Toastify({
                                                text: "Atenção! Erro ao buscar CEP.",
                                                duration: 4000,
                                                gravity: "top",
                                                position: "right",
                                                backgroundColor: "#dc2626",
                                                stopOnFocus: true,
                                            }).showToast();
                                        });
                                })
                                .catch(() => {
                                    Toastify({
                                        text: "Atenção! Erro ao buscar CEP.",
                                        duration: 4000,
                                        gravity: "top",
                                        position: "right",
                                        backgroundColor: "#dc2626",
                                        stopOnFocus: true,
                                    }).showToast();
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