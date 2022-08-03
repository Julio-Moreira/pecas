<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" zcontent="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="shortcut icon" href="icones/favicon.png" type="image/x-icon">
    <title>Resultado</title>
</head>
<body>
    <main>
        <?php
            // nome da peça 
            $nomePeca = $_POST['nome'] ?? 'desconhecido';
            $uni = $_POST['uni'] ?? 1;
            $comp = $_POST['comp'] ?? 1;
            $lucro = htmlspecialchars($_POST['lucro'] ?? 5);
            $tempo = htmlspecialchars($_POST['tempo'] ?? 10);
            $precoTempo = htmlspecialchars($_POST['precoTempo'] ?? 1);

            function convertToM($valor) {
                return $valor/100;
            }

            // Materiais
            $materiais = [ 'unidades' => [ ], 'comprimento' => [ ] ];

            // Unidades 
            for ($i=0; $i < $uni; $i++) { 
                $nomeMatUni = htmlspecialchars($_POST["nomeUni_$i"] ?? "sem nome");
                $precoMatUni = htmlspecialchars($_POST["precoUni_$i"] ?? 1);
                $usuMatUni   = htmlspecialchars($_POST["usadoUni_$i"] ?? 2);
                
                array_push($materiais['unidades'],
                    [ $nomeMatUni,
                    $precoMatUni,
                    $usuMatUni ]
                );
            }

            // Comprimento
            for ($i=0; $i < $comp; $i++) { 
                $nomeMatComp = htmlspecialchars($_POST["nomeComp_$i"] ?? 'sem nome');
                $precoMatComp = htmlspecialchars($_POST["precoComp_$i"] ?? 1);
                $tipoPrecoMat = htmlspecialchars($_POST["tipoComp_preco_$i"] ?? 'cm');
                $usuMatComp = htmlspecialchars($_POST["usadoComp_$i"] ?? 2);  
                $tipoUsuMat = htmlspecialchars($_POST["tipoComp_usada_$i"] ?? 'cm');
                
                array_push($materiais['comprimento'], 
                    [ $nomeMatComp,
                    [ $precoMatComp, $tipoPrecoMat],
                    [ $usuMatComp, $tipoUsuMat] ]
                );
            }

            $unidadesCalc = array_reduce($materiais['unidades'], 
                fn($valorAcumulado, $valorAtual) => $valorAcumulado + ($valorAtual[1] * $valorAtual[2])
            , 0);

            $comprimentoCalc = array_reduce($materiais['comprimento'],
                function($valorAcumulado, $valorAtual) {
                    $cituacaoPossivel_1 = $valorAtual[1][1] == "m" && $valorAtual[2][1] == "cm";
                    $cituacaoPossivel_2 = $valorAtual[1][1] == "cm" && $valorAtual[2][1] == "m";
                    
                    if ( ($cituacaoPossivel_1) || ($cituacaoPossivel_2) ) {
                        return ($cituacaoPossivel_1) 
                            ? $valorAcumulado + (convertToM($valorAtual[1][0]) * $valorAtual[2][0]) 
                            : $valorAcumulado + ($valorAtual[1][0] + convertToM($valorAtual[2][0]));
                    } else {
                        return $valorAcumulado + ($valorAtual[1][0] * $valorAtual[2][0]);
                    }
                }
            , 0);
        
            $tempoFinal = $tempo * $precoTempo;
            $contaFinal = ($unidadesCalc + $comprimentoCalc) + $tempoFinal;
            $lucroPorcentagem = (($contaFinal*$lucro)/100) + $contaFinal;
            $final = ($lucro > 0) ? number_format($lucroPorcentagem, 2, ',', '.') : number_format($contaFinal, 2, ',', '.');

            echo "<h1> Peça: </h1> 
            <p>
                Nome: $nomePeca <br>
                Horas gastas: $tempo
            </p>
            ";

            // lista de materiais
            echo "<h3> Materiais: </h3> 
            <ul>";
                // Unidades
                for ($i=0; $i < count($materiais['unidades']); $i++) {
                    $materialAtual = $materiais['unidades'][$i];

                    echo "<li> $materialAtual[0] </li> 
                    <ul>
                        <li> preço: $materialAtual[1] <br>
                        <li> quantidade: $materialAtual[2]
                    </ul>";
                }

                // Comprimento
                for ($i=0; $i < count($materiais['comprimento']); $i++) { 
                    $materialAtual = $materiais['comprimento'][$i];

                    echo "<li> $materialAtual[0]
                    <ul>
                        <li> preço: ". $materialAtual[1][0] . " por ". $materialAtual[1][1]. " <br>
                        <li> quantidade: ". $materialAtual[2][0] . " por ". $materialAtual[2][1]. "
                   </ul>";
                }
            echo "</ul>";

            echo "<p id='final'> Preço final da peça: <strong>$final</strong> </p>";
        ?>
    </main>

    <footer>
        Desenvolvido por: <strong>Julio C. Moreira</strong> (2022) <br>
        <a target="_blank" href="https://icons8.com/icon/bIkUnVRhKQXH/cloth">Cloth</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a> <br>
        <a href="https://www.github.com/Julio-Moreira/pecas">Codigo fonte</a>
    </footer>
</body>
</html>