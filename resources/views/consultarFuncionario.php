<!DOCTYPE html>
<html>
<head>
    <title>Consultar Funcionário</title>
    <link rel="stylesheet" type="text/css" href="/css/estilo.css">
</head>
<body>
    <h1>Consultar Funcionário</h1>

    <form action="/consultar" method="POST">
        ID: <input type="text" name="id_func"><br>
        Nome: <input type="text" name="nome_func"><br>
        <button type="submit">Consultar</button>
    </form>
</body>
</html>