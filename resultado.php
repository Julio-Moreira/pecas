<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" zcontent="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <section>
        <?php 
        // nome da peça 
        $nomePeca = $_POST['nome'];
        $uni = $_POST['uni'];
        $comp = $_POST['comp'];

        // Materiais
        $materiais = [ ];

        // Unidades [ nome, preco, comprada, usada ]
        for ($i=0; $i < $uni; $i++) { 
            $nomeMatUni = $_POST["nomeUni_$i"] ?? "desconhecido";
            $precoMatUni = $_POST["precoUni_$i"] ?? 1;
            $usuMatUni   = $_POST["usadoUni_$i"] ?? 2;
            
            array_push($materiais,
                [ $nomeMatUni,
                $precoMatUni,
                $usuMatUni ]
            );
        }

        // Comprimento
        for ($i=0; $i < $comp; $i++) { 
            $nomeMatComp = $_POST["nomeComp_$i"] ?? 'desconhecido';
            $precoMatComp = $_POST["precoComp_$i"] ?? 1;
            $tipoPrecoMat = $_POST["tipoComp_preco_$i"] ?? 'cm';
            $usuMatComp = $_POST["usadoComp_$i"] ?? 2;  
            $tipoUsuMat = $_POST["tipoComp_usada_$i"] ?? 'cm';
            
            array_push($materiais, 
                [ $nomeMatComp,
                $precoMatComp,
                $tipoPrecoMat,
                $usuMatComp,
                $tipoUsuMat ]
            );
        }
        ?>
    </section>
</body>
</html>