<?php

    /** Instânciamento de classes **/
    include_once './vendor/autoload.php';

    /** Importação de classes */
    use \vendor\model\Main;

    /** Instânciamento de classes */
    $Main  = new Main();

    /** Execução de método */
    $Main->SessionStart();
    $config = $Main->LoadConfigPublic();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <base href="<?php echo utf8_encode($config->url_aplicacao)?>"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="pt-br, en, fr, it">
    <meta name="viewport" pincontent="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="PT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="resource-types" content="document" />
    <meta name="revisit-after" content="1" />
    <meta name="classification" content="Internet" />
    <meta name="robots" content="index,follow" />
    <meta name="distribution" content="Global" />
    <meta name="rating" content="General" />
    <meta name="audience" content="all" />
    <meta name="language" content="pt-br" />
    <meta name="doc-class" content="Completed" />
    <meta name="doc-rights" content="Public" />
    <meta name="revisit-after" content="1 days" />
    <meta name="googlebot" content="index, follow" />
    <meta name="title" content="Graciele Fotografia" />
    <meta name="copyright" content="Graciele Fotografia" />
    <meta name="author" content="Keven Willian" />
    <meta name="keywords" content="suporte, assessoria, serviÃ§os, ti, nuvem, cloud, computing, ri, sistema, cartÃ³rios, ri, registro, matricula, certidÃ£o, Ã´nus, livro 2, livro2, livro3, nascimento, casamento, natimorto, notas, protesto, tabeliÃ£o, tabeliÃ£, oficial, serventia, selo, ficha, imÃ³vel, escritura, lote, ficha, auxiliar, escrivÃ£, escrivÃ£o, sites, portais, aplicativos, publicidade, ged, gerenciamento, documentos, provimento 74, provimento 88. provimento 86, provimento 63, provimentos,  Tabelionato de Notas, Protesto de TÃ­tulos e Documentos, Registro de TÃ­tulos e Documentos, Registro de ImÃ³veis, Welber Eduardo de Jesus, Kenio de Souza, Keven Willian, Rodrigo Moreira da Silva Moura, Iolanda Fernandes, JosÃ© Euripedes" />
    <meta name="description" content="Graciele Fotografia" />

    <title>

        MyCMS | Souza Consultoria Tecnologica

    </title>

    <!-- Importação de arquivos de estilo -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/animate-dropdown.css">
    <link rel="stylesheet" href="css/timeline.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/block.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/modal.css">

    <!-- Importação de arquivos javascript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/ckeditor.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/form.js"></script>
    <script src="js/block.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/file.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <?php

    /** Verifico se o usuário já esta autenticado */
    if (@(int)$_SESSION['USER_ID'] > 0)
    { ?>

        <?php include "vendor/view/geral/header.php";?>

        <script type="text/javascript">

            /** Redirecionamento de página */
            $(document).ready(function(e) {

                request('FOLDER=VIEW&TABLE=GERAL&ACTION=HOME');

            });

        </script>

       <div class="container">

           <div id="page-wrapper" class="mt-3"></div>
           
       </div>

    <?php }
    else
    { ?>

        <script type="text/javascript">

            $(document).ready(function(e) {

                request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_LOGIN');

            });

        </script>

        <div id="page-wrapper" class="m-3"></div>

    <?php }?>

</body>
</html>

