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

    <base href="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>"/>
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
    <link rel="icon" href="favicon.ico">

    <title>

        MyCMS | Souza Consultoria Tecnologica

    </title>

    <!-- Importação de arquivos de estilo -->
    <link rel="stylesheet" href="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>css/normalize.css">
    <link rel="stylesheet" href="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>css/animate-dropdown.css">
    <link rel="stylesheet" href="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>css/timeline.css">
    <link rel="stylesheet" href="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>css/block.css">
    <link rel="stylesheet" href="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>css/main.css">
    <link rel="stylesheet" href="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>css/modal.css">

    <!-- Importação de arquivos javascript -->
    <script src="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>js/jquery.min.js"></script>
    <script src="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>js/main.js"></script>
    <script src="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>js/ckeditor.js"></script>
    <script src="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>js/popper.min.js"></script>
    <script src="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>js/bootstrap.min.js"></script>
    <script src="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>js/bootstrap-select.min.js"></script>
    <script src="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>js/form.js"></script>
    <script src="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>js/block.js"></script>
    <script src="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>js/modal.js"></script>
    <script src="<?php echo utf8_encode(@(string)$config->url_aplicacao)?>js/file.js"></script>

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
