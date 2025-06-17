import IMask from 'imask';
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

function calcularIdadeTexto(dataNascimentoStr, destinoInput) {
    const nascimento = new Date(dataNascimentoStr);
    const hoje = new Date();

    if (!dataNascimentoStr || isNaN(nascimento)) {
        destinoInput.value = '';
        return;
    }

    const diffEmMs = hoje - nascimento;
    const diffData = new Date(diffEmMs);
    const anos = diffData.getUTCFullYear() - 1970;

    if (anos >= 1) {
        destinoInput.value = anos + (anos === 1 ? ' ano' : ' anos');
    } else {
        const meses = hoje.getMonth() - nascimento.getMonth() + (12 * (hoje.getFullYear() - nascimento.getFullYear()));
        destinoInput.value = (meses < 1 ? 0 : meses) + (meses === 1 ? ' mês' : ' meses');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const dataInput = document.getElementById('paciente_data_nascimento');
    const idadeInput = document.getElementById('paciente_idade');

    if (dataInput && idadeInput) {
        dataInput.addEventListener('change', function () {
            calcularIdadeTexto(this.value, idadeInput);
        });

        if (dataInput.value) {
            calcularIdadeTexto(dataInput.value, idadeInput);
        }
    }
});

document.querySelectorAll('.cpf-mask').forEach((el) => {
    IMask(el, {
        mask: '000.000.000-00'
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const cepInput = document.getElementById('paciente_cep');
    const enderecoInput = document.getElementById('paciente_endereco');

    cepInput.addEventListener('blur', function () {
        let cep = cepInput.value.replace(/\D/g, '');

        // registrar aqui
        if (cep.length === 8) {
            fetch(`/api/cep/${cep}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        enderecoInput.value = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                    } else {
                        enderecoInput.value = '';
                        Toastify({
                            text: "Atenção! CEP não encontrado.",
                            duration: 4000,
                            gravity: "top", 
                            position: "right",
                            backgroundColor: "#dc2626",
                            stopOnFocus: true,
                        }).showToast();
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
        }
    });
});

IMask(
  document.getElementById('paciente_cep'),
  {
    mask: '00000-000'
  }
)