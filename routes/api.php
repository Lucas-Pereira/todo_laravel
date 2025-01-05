<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\ProjetoController;
use App\Http\Middleware\checkValidacao;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/


Route::post('/user/login', [UsersController::class, 'login'])->name('login');
Route::post('/user/registrar', [UsersController::class, 'store']);
//Route::post('/api/user', [UsersController::class, 'store']);
//Route::get('/api/user', 'UsersController@getUser')->middleware();
//Route::get('/api', [UsersController::class, 'index']);
//Route::apiResource('user', UsersController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tarefa', [TarefaController::class, 'index']);
    Route::get('/tarefa/{id}', [TarefaController::class, 'getTarefaById']);
    Route::post('/tarefa', [TarefaController::class, 'store']);
    Route::put('/tarefa/{id}', [TarefaController::class, 'update']);
    Route::delete('/tarefa/{id}', [TarefaController::class, 'destroy']);

    //Route::apiResource('/projeto', ProjetoController::class);
    Route::get('/projeto', [ProjetoController::class, 'index']);
    Route::post('/projeto', [ProjetoController::class, 'store']);
    Route::put('/projeto/{id}', [ProjetoController::class, 'update']);
    Route::delete('/projeto/{id}', [ProjetoController::class, 'destroy']);
    Route::get('/projeto/{id}/tarefas', [ProjetoController::class, 'getTarefasByProjetoId']);
});
