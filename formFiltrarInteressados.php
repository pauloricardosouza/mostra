
<?php include("header.php"); ?>

<div class="col-sm-8">

    <h2>Filtrar interessados por Curso:</h2>

    <form action="formFiltrarInteressados.php?pagina=formFiltrarInteressados" method="POST">
        <div class="form-floating mb-3 mt-3">
            <select class="form-select" name="filtroCurso" required>
                <option value="" selected disabled hidden>Clique aqui para selecionar</option>
                <option value="TECIINT">Técnico em Informática para Internet</option>
                <option value="TECPJD">Técnico em Programação de Jogos Digitais</option>
                <option value="TECMEC">Técnico em Mecânica</option>
                <option value="TECAUT">Técnico em Automação Industrial</option>
                <option value="TECIINT">Técnico em Informática para Internet</option>
                <option value="SUPTADS">Tecnologia em Análise e Desenvolvimento de Sistemas</option>
                <option value="SUPTMI">Tecnologia em Manutenção Industrial</option>
                <option value="SUPTAI">Tecnologia em Automação Industrial</option>
                <option value="SUPLFIS">Licenciatura em Física</option>
                <option value="SUPENGEL">Bacharelado em Engenharia Elétrica</option>
            </select>
            <label for="filtroCurso" class="form-label">Selecione um Curso:</label>
        </div>

        <div style="margin-top:30px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-filter"></i> Filtrar</button>
        </div>
    
    </form>

    <?php
        //PHP para realizar a pesquisa no Banco de Dados

        //Verifica se há alguma informação sendo recebida chamada "tipoPesquisa"
        if(isset($_POST["filtroCurso"])){
            //Armazena nas variáveis os dados informados no formulário
            $filtroCurso = $_POST["filtroCurso"];

            include("conexaoBD.php");

            //Criar o SQL para realizar a pesquisa com filtro
            $filtrarInteressados = "SELECT * FROM Interessados WHERE cursoInteresse LIKE '$filtroCurso' ";

            //Executar a QUERY
            $res = mysqli_query($link, $filtrarInteressados) or die("<div class='alert alert-danger'>Erro ao tentar aplicar o filtro!</div>" . mysqli_error($link));

            //Contabilizar os Interessados encontrados pela pesquisa
            $totalInteressadosEncontrados = mysqli_num_rows($res);

            switch($filtroCurso){
                case "TECIINT" : $filtroCurso = "Técnico em Informática para Internet";
                break;

                case "TECPJD" : $filtroCurso = "Técnico em Programação de Jogos Digitais";
                break;

                case "TECMEC" : $filtroCurso = "Técnico em Mecânica";
                break;

                case "TECAUT" : $filtroCurso = "Técnico em Automação Industrial";
                break;

                case "SUPTADS" : $filtroCurso = "Tecnologia em Análise e Desenvolvimento de Sistemas";
                break;

                case "SUPTMI" : $filtroCurso = "Tecnologia em Manutenção Industrial";
                break;

                case "SUPTAI" : $filtroCurso = "Tecnologia em Automação Industrial";
                break;

                case "SUPLFIS" : $filtroCurso = "Licenciatura em Física";
                break;

                case "SUPENGEL" : $filtroCurso = "Bacharelado em Engenharia Elétrica";
                break;

                default: echo "Curso Inexistente";
                break;
            }

            if($totalInteressadosEncontrados > 0){
                if($totalInteressadosEncontrados == 1){
                    echo "<div class='alert alert-success text-center'>
                        Há <strong>$totalInteressadosEncontrados</strong> pessoa interessada no curso de <b>$filtroCurso</b>. <i class='bi bi-emoji-smile'></i>
                        </div>";
                }
                else{
                    echo "<div class='alert alert-success text-center'>
                        Há <strong>$totalInteressadosEncontrados</strong> pessoas interessadas no curso de <b>$filtroCurso</b>. <i class='bi bi-emoji-grin'></i>
                        </div>";
                }

                //Monta a tabela para exibir os registros encontrados
                echo "
                <table class='table'>
                    <thead class='thead-light'>
                        <tr>
                            <th>NOME</th>
                            <th>EMAIL</th>
                        </tr>
                    </thead>";

                    // Varre a tabela em busca de registros e armazena em um array
                    //Enquanto houverem dados na linha da tabela, atribui o valor atual do array a uma variável
                    while($registro = mysqli_fetch_assoc($res)){
                        $idInteressado       = $registro["idInteressado"];
                        $nomeInteressado     = $registro["nomeInteressado"];
                        $cursoInteresse      = $registro["cursoInteresse"];
                        $emailInteressado    = $registro["emailInteressado"];

                        //Cria uma linha da tabela com os registros encontrados
                        echo "
                            <tbody>
                                <tr>
                                    <td>$nomeInteressado</td>
                                    <td>$emailInteressado</td>
                                </tr>
                            </tbody>";
                    }
                echo "</table>";
            }
            else{
                echo "<div class='alert alert-warning text-center'>Ainda não há pessoas interessadas no curso de <b>$filtroCurso</b>. <i class='bi bi-emoji-tear'></i></div>";
            }
        }
    ?>

</div>

<?php include("footer.php") ?>