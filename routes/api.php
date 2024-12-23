<?php

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
//Route::post('/api/user', [UsersController::class, 'store']);
//Route::get('/api/user', 'UsersController@getUser')->middleware();
//Route::get('/api', [UsersController::class, 'index']);
Route::middleware('auth:sanctum', checkValidacao::class)->group(function () {
    Route::apiResource('user', UsersController::class);
    Route::apiResource('/tarefa', TarefaController::class);
    Route::apiResource('/projeto', ProjetoController::class);

});
