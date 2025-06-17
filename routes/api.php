<?php

use App\Http\Controllers\Api\MedicoMockController;
use App\Http\Controllers\CepController;
use Illuminate\Support\Facades\Route;

Route::get('/medicos', [MedicoMockController::class, 'index'])
    ->name('api.medicos');

Route::get('/cep/{cep}', [CepController::class, 'buscar']);