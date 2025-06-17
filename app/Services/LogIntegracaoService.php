<?php

namespace App\Services;

use App\Models\LogIntegracao;
use Carbon\Carbon;

class LogIntegracaoService
{
    public static function registrar(array $dados): void
    {
        LogIntegracao::create([
            'endpoint'     => $dados['endpoint'],
            'metodo'       => $dados['metodo'],
            'payload'      => $dados['payload'] ?? null,
            'resposta'     => $dados['resposta'] ?? null,
            'status_http'  => $dados['status_http'] ?? null,
            'erro'         => $dados['erro'] ?? null,
            'criado_em'    => Carbon::now(),
        ]);
    }
}