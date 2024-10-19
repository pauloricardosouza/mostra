
<?php include("header.php"); ?>

<div class="col-sm-8">

    <?php
        if(isset($_GET["emailExistente"])){
            $emailExistente = $_GET["emailExistente"];
            echo "<div class='alert alert-info text-center'>O email <b>$emailExistente</b> já foi cadastrado anteriormente. <i class='bi bi-emoji-smile'></i></div>";
        }
    ?>
    
    <h2>Formulário para cadastro de interessados</h2>
    <br>

    <form action="actionInteressado.php?pagina=formInteressado" method="POST" enctype="multipart/form-data">

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe o seu nome Completo" name="nomeInteressado" required>
            <label for="nomeInteressado" class="form-label">*Nome Completo:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <select class="form-select" name="cursoInteresse">
                <option value="TECIINT">Técnico em Informática para Internet</option>
                <option value="TECPJD">Técnico em Programação de Jogos Digitais</option>
                <option value="TECMEC">Técnico em Mecânica</option>
                <option value="TECAUT">Técnico em Automação Industrial</option>
                <option value="SUPTADS" selected>Tecnologia em Análise e Desenvolvimento de Sistemas</option>
                <option value="SUPTMI">Tecnologia em Manutenção Industrial</option>
                <option value="SUPTAI">Tecnologia em Automação Industrial</option>
                <option value="SUPLFIS">Licenciatura em Física</option>
                <option value="SUPENGEL">Bacharelado em Engenharia Elétrica</option>
            </select>
            <label for="cursoInteresse" class="form-label">Curso de Interesse:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="email" class="form-control" placeholder="Informe o email" name="emailInteressado" required>
            <label for="emailInteressado" class="form-label">*Email:</label>
        </div>

        <div style="margin-top:30px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-person-add"></i> Cadastrar</button>
        </div>

    </form>

</div>

<?php include("footer.php");