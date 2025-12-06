<?php 
use App\Http\Controllers\ClienteController;

Route::post('/cliente', [ClienteController::class, 'crear']);
Route::post('/cliente/login', [ClienteController::class, 'login']);
Route::put('/cliente/modificar', [ClienteController::class, 'modificar']);
Route::post('/cliente/codigo', [ClienteController::class, 'generarCodigo']);