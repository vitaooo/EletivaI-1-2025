<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_forward" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprint Eventos</title>
</head>

<body>
    <div class="container_principal">


        <div id="cabecalhodiv">
            <div class="divtitulo">
                <h1 class="hcabecalho">S P R I N T <span class="hcabecalho-ev">E V E N T O S</span> </h1>
            </div>

            <div style="display: flex; justify-item: center; align-items: center; gap: 50px;">
                <p id="pcabecalho">Quem somos</p>
                <button id="bentrar" style="display: flex;"><a href="entrar.php">Entrar</a>
                    <span class="material-symbols-outlined">
                        arrow_forward
                    </span>
                </button>
            </div>
        </div>
        <hr style="
    margin-top: -4px;
    border: 1;
    border-radius: 10px;
    ">

        <section class="center">
            <div class="secao_bemvindo">
                <h2 class="secao_titulo">Transforme <br>seu clube com a melhor <br> gestão esportiva.</h2>
                <p class="secao_p">Utilizado pelas maiores feiras e congressos do Brasil. </p>
                <p class="secao_p">Faça aqui o gerenciamento de seus eventos esportivos e tenha tudo a um clique!</p>
                <div class="container-pai">
                    <button class="botao_cadastro" ><a href="cadastro.php">Cadastrar</a></button>
                </div>
            </div>
            <div class="secao_imagem">
                <img src="images/runner.png" class="corredor" alt="">
            </div>
        </section>
    </div>
    <script src="script.js"></script>
</body>

</html>