<?php

    /** Importação de classes */
    use \vendor\model\Main;
    use \vendor\model\GUsuario;
    use \vendor\controller\GUsuario\GUsuarioValidate;
    use vendor\model\GConfig;

    /** Instânciamento de classes */
    $Main = new Main();
    $GUsuario = new GUsuario;
    $GUsuarioValidate = new GUsuarioValidate();
    $GConfig = new GConfig();

    /** Operações */
    $Main->SessionStart();

    /** Busco o parâmetro de preferencias */
    $resultGConfig = json_decode(base64_decode($GConfig->Get(0, 'PREFERENCIAS', 'PREFERENCIAS')->TEXTO));

    /** Tratamento dos dados de entrada */
    $GUsuarioValidate->setUsuarioId(@(int)$_SESSION['USUARIO_ID']);

    /** Busca de registro */
    $resultUsuario = $GUsuario->Get($GUsuarioValidate->getUsuarioId());

    /** Defino o Local Onde Irá Salvar o Arquivo do Carrinho de Compras */
    $file = $resultGConfig->path_file_log . md5($resultUsuario->USUARIO_ID) . '.json';

    /** Verifico se o arquivo existe */
    if (is_file($file))
    {

        /** Carrego os Itens já Existentes */
        $history = json_decode(file_get_contents($file), TRUE);

    }

?>

<div class="bg-white shadow-sm rounded overflow-hidden animate slideIn border">

    <div class="px-4 pt-0 pb-4 cover" style="background-image: url('./image/desert.png')">

        <div class="media align-items-end profile-head">

            <div class="profile mr-3">

                <a type="button" class="btn btn-outline-light btn-sm btn-block mb-2" onclick="request('FOLDER=VIEW&amp;TABLE=USERS&amp;ACTION=USERS_FILE_COVER_FORM&amp;USER_ID=1')">

                    Alterar Capa

                </a>

                <a type="button" class="btn btn-outline-light btn-sm btn-block mb-2" onclick="request('FOLDER=VIEW&amp;TABLE=USERS&amp;ACTION=USERS_FILE_PROFILE_FORM&amp;USER_ID=1')">

                    Alterar Foto

                </a>

                <?php

                /** Verifico se a imagem esta preenchida */
                if (empty(@(string)$resultUsuario->FOTO))
                { ?>

                    <img src="image/astronaut.png" alt="keven" width="130" class="rounded mb-2 img-thumbnail">

                <?php }else{ ?>

                    <img src="data:image/jpeg;base64, <?php echo utf8_encode($resultUsuario->FOTO)?>" alt="keven" width="130" class="rounded mb-2 img-thumbnail">

                <?php }?>


                <a type="button" class="btn btn-outline-dark btn-sm btn-block" onclick="request('FOLDER=VIEW&amp;TABLE=USERS&amp;ACTION=USERS_PROFILE_FORM&amp;USER_ID=1')">

                    Editar Perfil

                </a>


            </div>

            <div class="media-body mb-5 text-white">

                <h4 class="mt-0 mb-0">

                    <?php echo utf8_encode($resultUsuario->NOME_COMPLETO)?> - <?php echo utf8_encode($resultUsuario->FUNCAO)?>

                </h4>

                <p class="mb-4">

                    @<?php echo utf8_encode($resultUsuario->LOGIN)?> - <cite><?php echo utf8_encode($resultUsuario->EMAIL)?></cite>

                </p>

            </div>

        </div>

    </div>

    <div class="bg-light p-4 d-flex justify-content-end text-center">

        <ul class="list-inline mb-0">

            <li class="list-inline-item">

                <h5 class="font-weight-bold mb-0 d-block">215</h5>

                <small class="text-muted">

                    <i class="fas fa-image mr-1"></i>

                    Postagens

                </small>

            </li>

            <li class="list-inline-item">

                <h5 class="font-weight-bold mb-0 d-block">745</h5>

                <small class="text-muted">

                    <i class="fas fa-user mr-1"></i>

                    Atendimentos

                </small>

            </li>

            <li class="list-inline-item">

                <h5 class="font-weight-bold mb-0 d-block">

                    340

                </h5>

                <small class="text-muted">

                    <i class="fas fa-user mr-1"></i>

                    Posição

                </small>

            </li>

        </ul>

    </div>

    <div class="px-4 mb-3">

        <h5 class="mb-0">

            <strong>Histórico</strong> de Atividades

        </h5>

        <div class="main-card card shadow-sm">

            <div class="card-body">

                <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">

                    <?php

                    /** Listo os acessos realizados */
                    foreach ($history as $keyResultHistory => $resultHistory)
                    { ?>

                        <div class="vertical-timeline-item vertical-timeline-element">

                            <div>

                                <span class="vertical-timeline-element-icon bounce-in">

                                    <i class="badge badge-dot badge-dot-xl <?php echo @(string)$resultHistory['class']?>"> </i>

                                </span>

                                <div class="vertical-timeline-element-content bounce-in">

                                    <h4 class="timeline-title">

                                        <?php echo @(string)$resultHistory['title']?>

                                    </h4>

                                    <p>

                                        <?php echo @(string)$resultHistory['description']?>

                                        <a href="javascript:void(0);" data-abc="true">

                                            <?php echo @(string)$resultHistory['date']?>

                                        </a>

                                        no seguinte IP

                                        <a href="javascript:void(0);" data-abc="true">

                                            <?php echo @(string)$resultHistory['ip']?>

                                        </a>

                                    </p>

                                    <span class="vertical-timeline-element-date">

                                        <?php echo @(string)$resultHistory['time']?>

                                    </span>

                                </div>

                            </div>

                        </div>

                    <?php }?>

                </div>

            </div>

        </div>

    </div>

</div>