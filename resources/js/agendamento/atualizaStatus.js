import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

document.addEventListener('DOMContentLoaded', function () {
    const selects = document.querySelectorAll('.status-select');

    selects.forEach(select => {
        select.addEventListener('change', async function () {
            const agendamentoId = this.dataset.id;
            const dataHoraStr = this.dataset.dataHora;
            const novoStatus = this.value;

            const dataHora = new Date(dataHoraStr);
            const agora = new Date();
            const diffHoras = (dataHora - agora) / (1000 * 60 * 60);

            if (novoStatus === '2' && diffHoras < 12) {

                Toastify({
                    text: "Este agendamento só pode ser cancelado até 12h antes do horário marcado.",
                    duration: 4000,
                    gravity: "top", 
                    position: "right",
                    backgroundColor: "#dc2626",
                    stopOnFocus: true,
                }).showToast();

                this.value = this.dataset.original; 
                return;
            }

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(`/agendamento/${agendamentoId}/atualizar-status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({ status: novoStatus })
                });

                const data = await response.json();

                if (data.success) {

                    Toastify({
                        text: "Status atualizado com sucesso.",
                        duration: 4000,
                        gravity: "top", 
                        position: "right",
                        backgroundColor: "#008000",
                        stopOnFocus: true,
                    }).showToast();

                } else {

                    Toastify({
                        text: "Erro ao atualizar o status.",
                        duration: 4000,
                        gravity: "top", 
                        position: "right",
                        backgroundColor: "#dc2626",
                        stopOnFocus: true,
                    }).showToast();

                }
            } catch (error) {
                console.error('Erro na requisição:', error);
                Toastify({
                    text: "Erro ao atualizar o status.",
                    duration: 4000,
                    gravity: "top", 
                    position: "right",
                    backgroundColor: "#dc2626",
                    stopOnFocus: true,
                }).showToast();
            }
        });
    });
});