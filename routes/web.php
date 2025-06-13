<?php

use App\Http\Controllers\AgendamentoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [AgendamentoController::class, 'index'])
    ->name('agendamento.index');

Route::get('/cadastro-agendamento', [AgendamentoController::class, 'create'])
    ->name('agendamento.create');

Route::post('/store-agendamento', [AgendamentoController::class, 'store'])
    ->name('agendamento-store');
