<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <title>Materiais</title>
</head>
<body>
    <?php
        // nome da peça
        $nome = $_GET['nome'];
        // Quantidades de materiais em unidades
        $uni = $_GET['uni'];
        // Quantidade de materiais em comprimentos
        $comp = $_GET['comp']
    ?>
    
    <section>
    <h1>Coloque os materiais usados na peça <?php echo $nome ?>: </h1>
    <form action="resultado.php" method="POST">
        <?php 
            // Unidades
            if ($uni > 0) {
                echo "<h3> Materiais por unidades: </h3>";

                for ($i=0; $i < $uni ; $i++) { 
                    // Separador
                    echo "<hr>";

                    // Nome
                    echo "<label for='nomeUni_$i'> Nome: </label>";
                    echo "<input type='text' name='nomeUni_$i' id='nomeUni_$i' maxlenght='30' size='15' required> <br>";

                    // Quantidade comprada
                    echo "<label for='compradaUni_$i'> Quantidade comprada: </label>";
                    echo "<input type='number' name='compradaUni_$i' id='compradaUni_$i' min='0' size='2' required> <br>";    
                    
                    // Quantidade usada
                    echo "<label for='usadoUni_$i'> Quantidade usada: </label>";
                    echo "<input type='number' name='usadoUni_$i' id='usadoUni_$i' min='0' size='2' required>";
                }
            }

            // Comprimentos
            if ($comp > 0) {
                echo "<h3> Materiais por comprimento: </h3>";

                for ($i=0; $i < $comp; $i++) { 
                    echo "<hr>";

                    // Nome
                    echo "<label for='nomeComp_$i'> Nome: </label>";
                    echo "<input type='text' name='nomeComp_$i' id='nomeComp_$i' maxlenght='30' size='15' required> <br>";

                    // Quantidade comprada
                    echo "<label for='compradaComp_$i'> Quantidade comprada: </label>";
                    echo "<input type='number' name='compradaComp_$i' id='compradaComp_$i' min='0' size='2' required> ";    
                    echo "<select name='tipoComp_comprada_$i'>";
                    echo "<option value='cm'> cm </option>";
                    echo "<option value='m'> m </option>";
                    echo "</select>  <br>";


                    // Quantidade usada
                    echo "<label for='usadoComp_$i'> Quantidade usada: </label>";
                    echo "<input type='number' name='usadoComp_$i' id='usadoComp_$i' min='0' size='2' required> ";
                    echo "<select name='tipoComp_usada_$i'>";
                    echo "<option value='cm'> cm </option>";
                    echo "<option value='m'> m </option>";
                    echo "</select>  <br>";
                }
            }

        ?>

        <br>
        <input type="submit" value="terminar"> <input type="reset" value="apagar dados">
    </form>

    </section>
</body>
</html>