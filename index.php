<?php include("header.php"); ?>

                <div class="col-sm-6">
                    
                    <h2>MOSTRA DE CURSOS <?php echo date("Y");?></h2>
                    <h5>Instituto Federal do Paraná, 19 de outubro de <?php echo date("Y");?></h5>

                    <!-- Carrossel -->
                    <div id="demo" class="carousel slide" data-bs-ride="carousel">

                        <!-- Indicdores - Pontos -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                        </div>

                        <!-- Slideshow / Carrossel -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/foto001.png" alt="Estudantes em Aula Prática" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="img/foto002.png" alt="Estudantes" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="img/foto003.png" alt="Estudantes" class="d-block w-100">
                            </div>
                        </div>

                        <!-- Ícones de Esquerda / Direita -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>

                    <p class="text-center">Tecnologia em Análise e Desenvolvimento de Sistemas (TADS).</p>

                </div>

<?php include("footer.php"); ?>
         