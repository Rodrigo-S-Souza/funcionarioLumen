<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" type="text/css" href="/css/estilo.css">
    <script>
        var departamentosECargos = <?= json_encode($departamentosECargos) ?>;
        
        function updateCargos() {
            var departamento = document.querySelector('[name="nome_departamento"]').value;
            var cargoSelect = document.querySelector('[name="cargo_func"]');
            cargoSelect.innerHTML = '';

            if (departamento && departamentosECargos.hasOwnProperty(departamento)) {
                var cargos = departamentosECargos[departamento];
                cargos.forEach(function(cargo) {
                    var option = document.createElement('option');
                    option.value = cargo;
                    option.textContent = cargo;
                    cargoSelect.appendChild(option);
                });
            }
        }

        function checkGerenteLimit() {
            var cargo = document.querySelector('[name="cargo_func"]').value;
            var departamento = document.querySelector('[name="nome_departamento"]').value;

            if (cargo === 'Gerente') {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/verificarGerente?departamento=' + encodeURIComponent(departamento), true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if (xhr.responseText === '1') {
                            alert('Este departamento só pode ter um gerente. Caso deseje cadastrar um novo gerente, primeiro demita o atual.');
                            document.querySelector('[name="cargo_func"]').value = '';
                        }
                    }
                };
                xhr.send();
            } 
        }
    </script>
</head>
<body>
    <h1>Cadastrar Funcionário</h1>

    <form action="/cadastrar" method="POST">
        Nome: <input type="text" name="nome_func" required><br>
        Filial:
        <select name="nome_filial" required>
            <?php foreach ($filiais as $filial): ?>
                <option value="<?= htmlspecialchars($filial) ?>"><?= htmlspecialchars($filial) ?></option>
            <?php endforeach; ?>
        </select><br>
        Departamento:
        <select name="nome_departamento" required onchange="updateCargos()">
            <?php foreach ($departamentosECargos as $departamento => $cargos): ?>
                <option value="<?= htmlspecialchars($departamento) ?>"><?= htmlspecialchars($departamento) ?></option>
            <?php endforeach; ?>
        </select><br>
        Cargo:
        <select name="cargo_func" required onchange="checkGerenteLimit()">
            <option value="" disabled selected>Selecione o cargo</option>
        </select><br>
        Salário: <input type="number" name="sal_func" step="0.01" required><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>