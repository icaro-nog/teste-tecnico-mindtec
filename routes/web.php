<?php

use App\Http\Controllers\AgendamentoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// implementar rota pra onde?
// agendamento index

Route::get('/', [AgendamentoController::class, 'index'])
    ->name('agendamento.index');
