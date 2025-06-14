document.addEventListener('DOMContentLoaded', function () {
    const dataNascimentoInput = document.getElementById('paciente_data_nascimento');
    const idadeInput = document.getElementById('paciente_idade');

    dataNascimentoInput.addEventListener('change', function () {
        const nascimento = new Date(this.value);
        const hoje = new Date();

        if (!this.value || isNaN(nascimento)) {
            idadeInput.value = '';
            return;
        }

        const diffEmMs = hoje - nascimento;
        const diffData = new Date(diffEmMs);

        const anos = diffData.getUTCFullYear() - 1970;

        if (anos >= 1) {
            idadeInput.value = anos + (anos === 1 ? ' ano' : ' anos');
        } else {
            const meses = hoje.getMonth() - nascimento.getMonth() + (12 * (hoje.getFullYear() - nascimento.getFullYear()));
            idadeInput.value = (meses < 1 ? 0 : meses) + (meses === 1 ? ' mês' : ' meses');
        }
    });
});