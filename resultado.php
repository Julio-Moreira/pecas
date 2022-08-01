<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" zcontent="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <title>Resultado</title>
</head>
<body>
    <section>
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

            // Unidades [ nome, preco, comprada, usada ]
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

            echo "
            <header> <h1> Peça: </h1> </header> 
            
            <p>
            Nome: $nomePeca <br>
            Horas gastas: $tempo
            </p>
            ";

            // lista de materiais
            echo "<h2> Materiais: </h2> <ul>";
                // Unidades
                for ($i=0; $i < count($materiais['unidades']); $i++) {
                    $arrayAtual = $materiais['unidades'][$i];

                    echo "<li> ". $arrayAtual[0] . "</li>"; // nome
                    echo "<ul>";
                        echo "<li>preço: ". $arrayAtual[1];
                        echo "<li>quantidade: ". $arrayAtual[2];
                    echo "</ul>";
                }

                // Comprimento
                for ($i=0; $i < count($materiais['comprimento']); $i++) { 
                    $arrayAtual = $materiais['comprimento'][$i];

                    echo "<li>". $arrayAtual[0];
                    echo "<ul>";
                        echo "<li>preço: ". $arrayAtual[1][0] . " por ". $arrayAtual[1][1];
                        echo "<li>quantidade: ". $arrayAtual[2][0] . " por ". $arrayAtual[2][1];
                    echo "</ul>";
                }
            echo "</ul>";

            echo "Preço final da peça: <strong> <input type='number' id='final' size='3' step='0.1' value='$final'> </strong>";
        ?>
    </section>
</body>
</html>