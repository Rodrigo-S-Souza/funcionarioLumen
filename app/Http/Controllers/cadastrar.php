<?php
session_start();

require_once 'Controllers/conexao.php';

// validação dados do formulário
$nomeFunc = $_POST['nome_func'];
$nomeFilial = $_POST['nome_filial'];
$nomeDepartamento = $_POST['nome_departamento'];
$cargoFunc = $_POST['cargo_func'];
$salFunc = $_POST['sal_func'];

// executar query de inserção
$sql = "INSERT INTO funcionario (nome_func, nome_filial, nome_departamento, cargo_func, sal_func) VALUES ('$nomeFunc', '$nomeFilial', '$nomeDepartamento', '$cargoFunc', $salFunc)";

if ($conn->query($sql) === TRUE) {
    echo "Funcionário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar funcionário: " . $conn->error;
}

$conn->close();
?>