<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    /** @use HasFactory<\Database\Factories\ResponsavelFactory> */
    use HasFactory;

    protected $table = 'responsaveis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'paciente_id',
        'nome',
        'cpf',
        'grau_parentesco'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
