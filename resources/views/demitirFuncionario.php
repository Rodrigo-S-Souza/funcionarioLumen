<!DOCTYPE html>
<html>
<head>
    <title>Demitir Funcionário</title>
    <link rel="stylesheet" type="text/css" href="/css/estilo.css">
</head>
<body>
    <h1>Demitir Funcionário</h1>

    <form action="/demitir" method="POST">
        ID do Funcionário: <input type="number" name="id_func" required><br>
        <button type="submit">Demitir</button>
    </form>
</body>
</html>