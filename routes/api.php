<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgenciaController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\FreteController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\RastreamentoController;

Route::apiResource('/agencia', AgenciaController::class);
Route::apiResource('/unidade', UnidadeController::class);
Route::apiResource('/funcionario', FuncionarioController::class);
Route::apiResource('/cliente', ClienteController::class);
Route::apiResource('/servico', ServicoController::class);
Route::apiResource('/frete', FreteController::class);
Route::apiResource('/encomenda', EncomendaController::class);
Route::apiResource('/rastreamento', RastreamentoController::class);
Route::get('rastreamento/encomenda/{id}', [RastreamentoController::class, 'showRastreamentosRelatedToEncomenda']);

?>

