<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrestamoController;

Route::post('/prestamo', [PrestamoController::class, 'crear']);
Route::get('/prestamo/{id}', [PrestamoController::class, 'mostrar']);
Route::get('/prestamos', [PrestamoController::class, 'listar']);
Route::delete('/prestamo/{id}', [PrestamoController::class, 'finalizar']);
