<!DOCTYPE html>
<html>
<head>
    <title>Listar Funcionários</title>
    <link rel="stylesheet" type="text/css" href="/css/estilo.css">
</head>
<body>
    <h1>Listar Funcionários</h1>
    <?php if (empty($funcionarios)): ?>
        <p>Nenhum funcionário cadastrado.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Departamento</th>
                    <th>Cargo</th>
                    <th>Filial</th>
                    <th>Salário</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($funcionarios as $funcionario): ?>
                    <tr>
                        <td><?= htmlspecialchars($funcionario->id_func) ?></td>
                        <td><?= htmlspecialchars($funcionario->nome_func) ?></td>
                        <td><?= htmlspecialchars($funcionario->nome_departamento) ?></td>
                        <td><?= htmlspecialchars($funcionario->cargo_func) ?></td>
                        <td><?= htmlspecialchars($funcionario->nome_filial) ?></td>
                        <td><?= htmlspecialchars($funcionario->sal_func) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>