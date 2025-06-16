<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

// Route::fallback(function () {
//     return view('agendamento.index');
// });

Route::get('/agendamento', [AgendamentoController::class, 'index'])
    ->name('agendamento.index');

Route::get('/cadastro-agendamento', [AgendamentoController::class, 'create'])
    ->name('agendamento.create');

Route::post('/store-agendamento', [AgendamentoController::class, 'store'])
    ->name('agendamento.store');

Route::get('/paciente', [PacienteController::class, 'index'])
    ->name('paciente.index');

Route::get('/cadastro-paciente', [PacienteController::class, 'create'])
    ->name('paciente.create');

Route::post('/store-paciente', [PacienteController::class, 'store'])
    ->name('paciente.store');

Route::get('paciente/{paciente}/edit', [PacienteController::class, 'edit'])
    ->name('paciente.edit');

Route::put('paciente/{paciente}', [PacienteController::class, 'update'])
    ->name('paciente.update');

Route::delete('paciente/{paciente}', [PacienteController::class, 'destroy'])
    ->name('paciente.destroy');

Route::get('/autocomplete/paciente', [PacienteController::class, 'autocomplete'])
    ->name('paciente.autocomplete');

