<?php

/** Importação de classes */
use vendor\model\Configurations;

/** Instânciamento de Classes */
$Configurations = new Configurations();

/** Busco a configuração */
$resultConfiguration = $Configurations->All();

/** Decodifico as preferencias */
$resultConfiguration->preferences = (object)json_decode(base64_decode($resultConfiguration->preferences));

?>

<div class="row mt-3 animate slideIn">

    <div class="col-md-6">

        <h5>

            <strong>

                <i class="fas fa-cog mr-1"></i>Configuração

            </strong>

            /Listagem/

        </h5>

    </div>

    <?php

    /** Verifico se existem registros */
    if (@(int)$resultConfiguration->configuration_id === 0)
    { ?>

        <div class="col-md-6 text-right">

            <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_FORM')">

                <i class="fas fa-plus-circle mr-1"></i>Adicionar

            </button>

        </div>

    <?php }else{ ?>

        <div class="col-md-6 text-right">

            <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_FORM&CONFIGURATION_ID=<?php echo @(int)$resultConfiguration->configuration_id?>')">

                <i class="fas fa-pencil-alt mr-1"></i>Editar

            </button>

        </div>

    <?php }?>

    <?php

    /** Verifico se existem registros */
    if (@(int)$resultConfiguration->configuration_id === 0)
    { ?>

        <div class="col-md-12">

            <div class="alert alert-warning border-warning shadow-sm" role="alert">

                <h4 class="alert-heading">

                    <strong>

                        Ooops!

                    </strong>

                </h4>

                <p>

                    Nõ foram localizados registros

                </p>

            </div>

        </div>

    <?php }else{ ?>

        <div class="col-md-12 mt-1 mb-3">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">

                        <strong>

                            <?php echo utf8_encode(@(string)$resultConfiguration->title)?>

                        </strong>

                    </h5>

                    <h6 class="card-subtitle">

                        <?php echo utf8_encode(@(string)$resultConfiguration->description)?>

                    </h6>

                </div>

            </div>

        </div>

        <div class="col-md d-flex">

            <div class="card shadow-sm w-100">

                <div class="card-body">

                    <h6 class="card-title text-semi-bold">

                        <i class="fas fa-info-circle mr-1"></i>Sobre

                    </h6>

                    <ul class="list-unstyled">

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0 mb-1">

                                    <i class="fas fa-at mr-1"></i>Autor

                                </h6>

                                <p>

                                    <?php echo utf8_encode(@(string)$resultConfiguration->author)?>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                    <i class="far fa-copyright mr-1"></i>Copyright

                                </h6>

                                <p>

                                    <?php echo utf8_encode(@(string)$resultConfiguration->copyright)?>

                                </p>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <div class="col-md d-flex">

            <div class="card shadow-sm w-100">

                <div class="card-body">

                    <h6 class="card-title text-semi-bold">

                        <i class="fas fa-at mr-1"></i>Email

                    </h6>

                    <ul class="list-unstyled">

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                    <i class="fas fa-server mr-1"></i>Host

                                </h6>

                                <p>

                                    <?php echo utf8_encode(@(string)$resultConfiguration->preferences->email_host)?>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                    <i class="fas fa-user mr-1"></i>Usuário

                                </h6>

                                <p>

                                    <?php echo utf8_encode(@(string)$resultConfiguration->preferences->email_username)?>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                    <i class="fas fa-door-open mr-1"></i>Port

                                </h6>

                                <p>

                                    <?php echo utf8_encode(@(string)$resultConfiguration->preferences->email_port)?>

                                </p>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <div class="col-md d-flex">

            <div class="card shadow-sm w-100">

                <div class="card-body">

                    <h6 class="card-title text-semi-bold">

                        <i class="fas fa-info-circle mr-1"></i>Configurações

                    </h6>

                    <ul class="list-unstyled">

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0 mb-1">

                                    <i class="far fa-folder mr-1"></i>Caminho das Imagens

                                </h6>

                                <p>

                                    <?php echo utf8_encode(@(string)$resultConfiguration->preferences->file_path)?>

                                </p>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    <?php }?>

</div>