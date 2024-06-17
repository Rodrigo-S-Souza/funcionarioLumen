<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    private $filiais = ['Alpha', 'Beta', 'Delta', 'Gamma', 'Omega'];

    private $departamentosECargos = [
        'Administração' => ['Gerente', 'Assistente Administrativo'],
        'Comunicação' => ['Gerente', 'Analista de Marketing', 'Editor(a)', 'Publicitário(a)', 'Redator(a)'],
        'Financeiro' => ['Gerente', 'Analista Financeiro', 'Assistente Financeiro'],
        'Jurídico' => ['Gerente', 'Consultor(a) Jurídico(a)'],
        'Marketing' => ['Gerente', 'Analista de Marketing', 'Especialista em Marketing Digital', 'Publicitário(a)'],
        'Recursos Humanos' => ['Gerente', 'Analista de RH'],
        'TI' => ['Gerente', 'Analista de Sistemas', 'Analista de Suporte Técnico', 'Analista de TI', 'Projetista de Banco de Dados', 'Técnico(a) de Manutenção'],
        'Vendas' => ['Gerente', 'Analista de Vendas'],
    ];

    public function index()
    {
        return view('index');
    }

    public function cadastro()
    {
        return view('cadastrarFuncionario', [
            'filiais' => $this->filiais,
            'departamentosECargos' => $this->departamentosECargos,
        ]);
    }

    public function listar()
    {
        $funcionarios = Funcionario::all();
        return view('listarFuncionarios', ['funcionarios' => $funcionarios]);
    }

    public function cadastrar(Request $request)
    {
        $nomeDepartamento = $request->input('nome_departamento');

        $this->validate($request, [
            'nome_func' => 'required|string|min:5|max:100',
            'nome_filial' => 'required|string|in:' . implode(',', $this->filiais),
            'nome_departamento' => 'required|string|in:' . implode(',', array_keys($this->departamentosECargos)),
            'cargo_func' => 'required|string|in:' . (isset($this->departamentosECargos[$nomeDepartamento]) ? implode(',', $this->departamentosECargos[$nomeDepartamento]) : ''),
            'sal_func' => 'required|numeric|min:0',
        ]);

        Funcionario::create($request->only(['nome_func', 'nome_filial', 'nome_departamento', 'cargo_func', 'sal_func']));

        return redirect('/listar')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function consultar(Request $request)
{
    $id = $request->input('id_func');
    $searchTerm = $request->input('nome_func');

    // verificação de ID do funcionário
    if (!empty($id)) {
        $funcionarios = Funcionario::where('id_func', $id)->get();
    } else {
        // Pesquisa por nome
        $funcionarios = Funcionario::where('nome_func', 'LIKE', "%{$searchTerm}%")->get();
    }

    if ($funcionarios->isEmpty()) {
        return view('resultado', ['message' => 'Nenhum funcionário encontrado.']);
    } else {
        return view('resultado', ['funcionarios' => $funcionarios]);
    }
}

    public function demitir(Request $request)
    {
        $id = $request->input('id_func');
        $funcionario = Funcionario::find($id);

        if ($funcionario) {
            $funcionario->delete();
            return redirect('/listar')->with('success', 'Funcionário demitido com sucesso!');
        } else {
            return redirect('/listar')->with('error', 'Funcionário não encontrado.');
        }
    }
}
