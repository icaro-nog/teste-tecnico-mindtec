<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use App\Services\LogIntegracaoService;

class MedicoMockController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $json = file_get_contents(resource_path('mocks/medicos.json'));
            $data = json_decode($json, true);

            LogIntegracaoService::registrar([
                'endpoint' => 'mock.api.medicos',
                'metodo' => 'GET',
                'payload' => null,
                'resposta' => $data,
                'status_http' => 200,
            ]);

            return response()->json($data);
        } catch (\Exception $e) {
            LogIntegracaoService::registrar([
                'endpoint' => 'mock.api.medicos',
                'metodo' => 'GET',
                'payload' => null,
                'erro' => $e->getMessage(),
                'status_http' => 500,
            ]);

            return response()->json(['erro' => 'Erro ao carregar médicos mock'], 500);
        }
    }
}
