<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/medicos', function () {

    $json = Storage::get('medicos.json');

    return response()->json(json_decode($json));
})->name('api.medicos');
