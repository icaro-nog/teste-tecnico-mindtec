<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\LogIntegracaoService;

class CepController extends Controller
{
    public function buscar($cep)
    {
        try {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

            LogIntegracaoService::registrar([
                'endpoint' => "https://viacep.com.br/ws/{$cep}/json/",
                'metodo' => 'GET',
                'payload' => null, // requisição get
                'resposta' => $response->json(),
                'status_http' => $response->status(),
            ]);

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            LogIntegracaoService::registrar([
                'endpoint' => "https://viacep.com.br/ws/{$cep}/json/",
                'metodo' => 'GET',
                'erro' => $e->getMessage(),
            ]);

            return response()->json(['erro' => 'Erro ao consultar o CEP'], 500);
        }
    }
}
