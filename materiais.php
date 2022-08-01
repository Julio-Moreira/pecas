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
        $nome = htmlspecialchars($_GET['nome'] ?? 'desconhecido');
        // Quantidades de materiais em unidades
        $uni = htmlspecialchars($_GET['uni'] ?? 1);
        // Quantidade de materiais em comprimentos
        $comp = htmlspecialchars($_GET['comp'] ?? 1);
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
       
                    // Preço                                                        
                    echo "<label for='precoUni_$i'> Preço: </label>";
                    echo "<input type='number' name='precoUni_$i' id='precoUni_$i' min='0' size='2' step='0.1' required> ";    

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

                    // Preço
                    echo "<label for='precoComp_$i'> Preço: </label>";
                    echo "<input type='number' name='precoComp_$i' id='precoComp_$i' min='0' size='2' step='0.1' required> ";    
                    echo "<select name='tipoComp_preco_$i'>";
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

        <!-- info da peça -->
        <input type="hidden" name="nome" value="<?php echo $nome ?>">
        <input type="hidden" name="uni" value="<?php echo $uni ?>">
        <input type="hidden" name="comp" value="<?php echo $comp ?>">
        <input type="hidden" name="lucro" value="<?php echo $_GET['lucro'] ?>">
        <input type="hidden" name="tempo" value="<?php echo $_GET['tempo'] ?>">
        <input type="hidden" name="precoTempo" value="<?php echo $_GET['precoTempo'] ?>">
            
        <!-- botoes -->
        <input type="submit" value="terminar"> <input type="reset" value="apagar dados">
    </form>

    </section>
</body>
</html>