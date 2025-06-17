<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogIntegracao extends Model
{
    public $timestamps = false;

    protected $table = 'log_integracao';

    protected $fillable = [
        'endpoint',
        'metodo',
        'payload',
        'resposta',
        'status_http',
        'erro',
        'criado_em',
    ];

    protected $casts = [
        'payload' => 'array',
        'resposta' => 'array',
        'criado_em' => 'datetime',
    ];
}
