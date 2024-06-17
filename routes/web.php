<?php

use Laravel\Lumen\Routing\Router;
use Illuminate\Http\Request;
use App\Models\Funcionario;

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', 'FuncionarioController@index');
$router->get('/index', 'FuncionarioController@index');

$router->get('/cadastrar', 'FuncionarioController@cadastro');
$router->post('/cadastrar', 'FuncionarioController@cadastrar');

$router->get('/listar', 'FuncionarioController@listar');
$router->get('/consultar', function () {
    return view('consultarFuncionario');
});
$router->post('/consultar', 'FuncionarioController@consultar');
$router->get('/demitir', function () {
    return view('demitirFuncionario');
});
$router->post('/demitir', 'FuncionarioController@demitir');

$router->get('/verificarGerente', function (Request $request) {
    $departamento = $request->query('departamento');
    $gerente = Funcionario::where('nome_departamento', $departamento)
        ->where('cargo_func', 'Gerente')
        ->first();
    return response()->json($gerente ? 1 : 0);
});