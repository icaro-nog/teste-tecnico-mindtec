<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    /** @use HasFactory<\Database\Factories\PacienteFactory> */
    use HasFactory;

    protected $table = 'pacientes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'endereco_completo'
    ];

    public function responsaveis()
    {
        return $this->hasMany(Responsavel::class);
    }

    public function getIdadeFormatadaAttribute()
    {
        if (!$this->data_nascimento) {
            return null;
        }

        $hoje = Carbon::now();
        $nascimento = Carbon::parse($this->data_nascimento);
        $anos = $nascimento->diffInYears($hoje);

        if ($anos >= 1) {
            return ceil($anos). ' ' . 'ano(s)';
        }

        $meses = $nascimento->diffInMonths($hoje);
        return ceil($meses) . ' ' . 'mês(es)';
    }
}
