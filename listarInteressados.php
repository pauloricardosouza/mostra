<?php include("header.php") ?>

<div class="col-sm-8">
    <?php

        //Inclui o arquivo de conexão com o Banco de Dados
        include("conexaoBD.php");
    
        echo "<h2>Pessoas Interessadas</h2><br>";

        $listarInteressados = "SELECT * FROM Interessados"; //Seleciona todos os campos da tabela Interessados
        $res = mysqli_query($link, $listarInteressados); //Executa o comando de listagem
        $totalInteressados = mysqli_num_rows($res); //Função para retornar a quantidade de registros da tabela

        if($totalInteressados > 0){
            if($totalInteressados == 1){
                echo "<div class='alert alert-success text-center'>Há <strong>$totalInteressados</strong> interessado cadastrado! <i class='bi bi-emoji-smile'></i></div>";
            }
            else{
                echo "<div class='alert alert-success text-center'>Há <strong>$totalInteressados</strong> interessados cadastrados! <i class='bi bi-emoji-grin'></i></div>";
            }
            
            //Monta a tabela para exibir os registros encontrados
            echo "
                <table class='table'>
                    <thead class='thead-light'>
                        <tr>
                            <th>NOME</th>
                            <th>CURSO DE INTERESSE</th>
                            <th>EMAIL</th>
                        </tr>
                    </thead>";

                    // Varre a tabela em busca de registros e armazena em um array
                    //Enquanto houverem dados na linha da tabela, atribui o valor atual do array a uma variável
                    while($registro = mysqli_fetch_assoc($res)){
                        $idInteressado       = $registro["idInteressado"];
                        $nomeInteressado     = $registro["nomeInteressado"];
                        $cursoInteresse    = $registro["cursoInteresse"];
                        $emailInteressado    = $registro["emailInteressado"];

                        switch($cursoInteresse){
                            case "TECIINT" : $cursoInteresse = "Técnico em Informática para Internet";
                            break;
    
                            case "TECPJD" : $cursoInteresse = "Técnico em Programação de Jogos Digitais";
                            break;
    
                            case "TECMEC" : $cursoInteresse = "Técnico em Mecânica";
                            break;
    
                            case "TECAUT" : $cursoInteresse = "Técnico em Automação Industrial";
                            break;
    
                            case "SUPTADS" : $cursoInteresse = "Tecnologia em Análise e Desenvolvimento de Sistemas";
                            break;
    
                            case "SUPTMI" : $cursoInteresse = "Tecnologia em Manutenção Industrial";
                            break;
    
                            case "SUPTAI" : $cursoInteresse = "Tecnologia em Automação Industrial";
                            break;
    
                            case "SUPLFIS" : $cursoInteresse = "Licenciatura em Física";
                            break;
    
                            case "SUPENGEL" : $cursoInteresse = "Bacharelado em Engenharia Elétrica";
                            break;
    
                            default: echo "Curso Inexistente";
                            break;
                        }

                        //Cria uma linha da tabela com os registros encontrados
                        echo "
                            <tbody>
                                <tr>
                                    <td>$nomeInteressado</td>
                                    <td>$cursoInteresse</td>
                                    <td>$emailInteressado</td>
                                </tr>
                            </tbody>";
                    }
                echo "</table>";
        }
        else{
            echo "<div class='alert alert-warning text-center'>Ainda não há pessoas interessadas em nossos cursos! <i class='bi bi-emoji-frown'></i></div>";
        }
        
    ?>
</div>

<?php include("footer.php") ?>