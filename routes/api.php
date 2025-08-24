<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\AgenciaController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicoController;

Route::apiResource('/agencia', AgenciaController::class);
Route::apiResource('/unidade', UnidadeController::class);
Route::apiResource('/funcionario', FuncionarioController::class);
Route::apiResource('/cliente', ClienteController::class);
Route::apiResource('/servico', ServicoController::class);



?>

