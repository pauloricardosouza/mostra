<?php include("header.php") ?>

<div class="col-sm-8">

    <?php
        //Área para declaração das variáveis
        $nomeInteressado = $cursoInteresse = $emailInteressado = "";

        //Pega a hora e a data Atual
        $horaAtual = date("H:i");
        $dataAtual = date("Y/m/d");
        $diaAtual = date("d");
        $anoAtual = date("Y");

        $linkInscricao = "https://portaldocandidato.ifpr.edu.br";

        $tudoCerto = true; //Essa variável será responsável por verificar se os campos foram devidamente preenchidos;

        if($_SERVER["REQUEST_METHOD"] == "POST"){ //Verifica o método de envio do FORM
            if(empty($_POST["nomeInteressado"])){
                echo "<div class='alert alert-warning'>O campo<strong>NOME</strong> é obrigatório!</div>";
                $tudoCerto = false;
            }
            else{
                $nomeInteressado = testar_entrada($_POST["nomeInteressado"]);
                //A função preg_match define uma regra para aceitar apenas caracteres deste conjunto
                if (!preg_match("/^[a-zA-Z-' ]*$/",$nomeInteressado)){ //Usa a função preg_match para verificar se há apenas letras
                    echo "<div class='alert alert-warning text-center'>Atenção! No campo <strong>NOME</strong> somente letras são permitidas!</div>";
                    $tudoCerto = false;
                }
            }

            //Validação do campo CURSO DE INTERESSE
            $cursoInteresse = testar_entrada($_POST["cursoInteresse"]);

            $nivelCurso = substr($cursoInteresse, 0, 3);

            if ($nivelCurso == "TEC") {
                $prazoInscricao = "03 de outubro e 01 de novembro de 2024";
            } else{
                $prazoInscricao = "03 de outubro e 17 de janeiro de 2025";
            }

            echo "<h1>$nivelCurso</h1>";

            //Validação do campo EMAIL
            if(empty($_POST["emailInteressado"])){ //Usa a função empty para verificar se o campo está vazio
                echo "<div class='alert alert-warning text-center'>Atenção! O campo <strong>EMAIL</strong> é obrigatório!</div>";
                $tudoCerto = false;
            }
            else{
                $emailInteressado = testar_entrada($_POST["emailInteressado"]);

                //Verificar se o email já está cadastrado na base de dados
                include("conexaoBD.php");

                $verificarEmail = "SELECT emailInteressado
                                    FROM Interessados
                                    WHERE emailInteressado LIKE '$emailInteressado' ";

                $res = mysqli_query($link, $verificarEmail) or die("<div class='alert alert-danger text-center'>Erro ao tentar consultar <strong>EMAILS</strong> na base de dados!</div>");

                $totalEmailsCadastrados = mysqli_num_rows($res);

                if($totalEmailsCadastrados > 0){
                    $tudoCerto = false;
                    header("location:formInteressado.php?pagina=formInteressado&emailExistente=$emailInteressado");
                }
            }

            //Se estiver tudo certo
            if($tudoCerto){

                //Cria uma Query responsável por realizar a inserção dos dados no BD
                $inserirInteressado = "INSERT INTO Interessados (nomeInteressado, cursoInteresse, emailInteressado)
                                    VALUES ('$nomeInteressado', '$cursoInteresse', '$emailInteressado')";

                include("conexaoBD.php");

                //Função para executar QUERYs no Banco de Dados
                if(mysqli_query($link, $inserirInteressado)){

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

                    echo "<div class='container mt-3'>
                            <table class='table'>
                                <tr>
                                    <th>NOME</th>
                                    <td>$nomeInteressado</td>
                                </tr>
                                <tr>
                                    <th>CURSO DE INTERESSE</th>
                                    <td>$cursoInteresse</td>
                                </tr>
                                <tr>
                                    <th>EMAIL</th>
                                    <td>$emailInteressado</td>
                                </tr>
                            </table>
                        </div>
                    ";

                    $nomeCompletoInteressado = explode(' ', $nomeInteressado);
                    $primeiroNomeInteressado = $nomeCompletoInteressado[0];

                    //Atribui as informações necessárias do email que será enviado;
                    $remetente    = "paulo.silva@ifpr.edu.br";
                    $destinatario = $emailInteressado;

                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: <'.$remetente.'>';

                    $assunto      = "Processo Seletivo IFPR " . ($anoAtual+1);
                    $mensagem     = "<p>Olá, nobre <b>$nomeInteressado</b>!</p>
                            No dia $diaAtual de outubro de $anoAtual, às $horaAtual, você esteve no Instituto Federal Campus Telêmaco Borba
                            e demonstrou interesse no curso de <b>$cursoInteresse</b>.<br>
                            As inscrições para o Processo Seletivo 2025 estarão abertas entre os dias <b>$prazoInscricao</b>.<br>
                            <a href='$linkInscricao'><b>Clique aqui</b></a> para realizar a sua inscrição!<br>
                            Venha estudar conosco! ;D<br><br>
                            Atenciosamente, <br>
                            Docentes do Eixo de Informação e Comunicação do IFPR Campus Telemaco Borba.";

                    $enviarEmail = mail($destinatario, $assunto, $mensagem, $headers);

                    if($enviarEmail){
                        echo "<div class='alert alert-success text-center'>Informações cadastradas com sucesso, $primeiroNomeInteressado! Um email foi enviado para <strong>$destinatario</strong>! <i class='bi bi-emoji-grin'></i></div>";
                    }
                    else{
                        echo "<div class='alert alert-danger text-center'>Erro ao tentar enviar email para <strong>$destinatario</strong>! <i class='bi bi-emoji-frown'></i></div>" . mysqli_error($link);
                    }
                }

                else{
                    echo "<div class='alert alert-danger'>Erro ao tentar cadastrar <strong>Interessado</strong>! <i class='bi bi-emoji-dizzy'></i></div>" . mysqli_error($link);
                }
            }
        }

        //Função para testar as entradas de dados e evitar SQL Injection
        function testar_entrada($dado){
            $dado = trim($dado); //TRIM - Remove caracteres desnecessários (TABS, espaços, etc)
            $dado = stripslashes($dado); //Remove barras invertidas
            $dado = htmlspecialchars($dado); //Converte caracteres especiais em entidades HTML
            return($dado);
        }

    ?>

</div>

<?php include("footer.php") ?>