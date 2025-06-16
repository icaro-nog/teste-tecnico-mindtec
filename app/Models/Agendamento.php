<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    /** @use HasFactory<\Database\Factories\AgendamentoFactory> */
    use HasFactory;

    protected $table = 'agendamentos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'paciente_id',
        'nome_medico',
        'crm_medico',
        'cidade_medico',
        'uf_medico',
        'especialidade',
        'data_hora',
        'status',
    ];
}
