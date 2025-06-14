import IMask from 'imask';

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