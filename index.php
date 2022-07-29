<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <title>Peças</title>
</head>
<body>
    <section>
        <h1> Coloque as informações da peça nas caixas abaixo: </h1>
            <form action="materiais.php" method="get">
                <!-- Nome da peça -->
                <label for="nome"> Nome: </label>
                <input type="text" name="nome" id="nome" maxlength="30" required> <br>

                <!-- Quantidade de materiais -->
                <h4>Quantidade de materiais: </h4>
                <label for="uni"> Por <strong>unidades</strong>: </label>
                <input type="number" name="uni" id="uni" size="2" max="50" min="0" value="0"> <br>

                <label for="comp"> Por <strong>comprimento</strong>: </label>
                <input type="number" name="comp" id="comp" size="2" max="50" min="0" value="0"> <br>

                <!-- Submit -->
                <input type="submit" value="avançar"> <input type="reset" value="apagar dados">
            </form>
    </section>
</body>
</html>