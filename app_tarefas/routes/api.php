<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\StatusController;

Route::middleware(['api'])->group(function () {
    // Retorna o usuário autenticado
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout
    Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    });

    // Rotas protegidas por autenticação Sanctum
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('tarefas', TarefaController::class);
        Route::get('/status', [StatusController::class, 'index']);
    });
});
