<?php

/** Importação de classes */

use vendor\model\Configurations;

/** Instânciamento de Classes */
$Configurations = new Configurations();

/** Busco as configurações atuais */
$resultConfigurations = $Configurations->All();

?>

<div class="row mt-3 animate slideIn">

    <div class="col-md-6">

        <h5>

            <strong>

                <i class="fas fa-cog mr-1"></i>Configurações

            </strong>

            /Listagem/

        </h5>

    </div>

    <div class="col-md-6 text-right">

        <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_FORM&CONFIGURATION_ID=<?php echo utf8_encode(@(int)$resultConfigurations->configuration_id)?>')">

            <i class="fas fa-plus-circle mr-1"></i>Editar

        </button>

    </div>

    <div class="col-md-12 mb-3 mt-1">

        <div class="card shadow-sm">

            <div class="card-body">

                <h5 class="card-title">

                    <?php echo utf8_encode(@(string)$resultConfigurations->title)?>

                </h5>

                <h6 class="card-subtitle">

                    <?php echo utf8_encode(@(string)$resultConfigurations->author)?>

                </h6>

            </div>

        </div>

    </div>

    <div class="col-md-4 d-flex mb-1">

        <div class="card shadow-sm w-100">

            <div class="card-body">

                <h6 class="card-title text-semi-bold">

                    <i class="fas fa-info-circle mr-1"></i>Sobre

                </h6>

                <ul class="list-unstyled">

                    <li class="media">

                        <div class="media-body">

                            <h6 class="mt-0 mb-1">

                                <i class="fas fa-restroom mr-1"></i>Tabelião Nome

                            </h6>

                            <p>

                                asd asd asd
                            </p>

                        </div>

                    </li>

                    <li class="media">

                        <div class="media-body">

                            <h6 class="mt-0 mb-1">

                                <i class="fas fa-restroom mr-1"></i>Tabelião Cargo

                            </h6>

                            <p>

                                asd as d
                            </p>

                        </div>

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <div class="col-md-4 d-flex mb-1">

        <div class="card w-100 shadow-sm">

            <div class="card-body">

                <h6 class="card-title text-semi-bold">

                    <i class="fas fa-map-marker-alt mr-1"></i>Endereço

                </h6>

                <ul class="list-unstyled text-break mb-0">

                    <li class="media mb-2">

                        <i class="far fa-map align-top mr-2 mt-1"></i>

                        <div class="media-body">

                            asd asd, asd asd/asd asd, asd asd, asd asd, asd, asd asd
                        </div>

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <div class="col-md-4 d-flex mb-1">

        <div class="card w-100 shadow-sm">

            <div class="card-body">

                <h6 class="card-title text-semi-bold">

                    <i class="far fa-clock mr-1"></i>Valores

                </h6>

                <ul class="list-unstyled">

                    <li class="media">

                        <div class="media-body">

                            <h6 class="mt-0 mb-1">

                                <i class="fas fa-dollar-sign mr-1"></i>Percentual ISS

                            </h6>

                            <p>

                                5%

                            </p>

                        </div>

                    </li>

                    <li class="media">

                        <div class="media-body">

                            <h6 class="mt-0 mb-1">

                                <i class="fas fa-dollar-sign mr-1"></i>Fundos Estaduais

                            </h6>

                            <p>

                                45%

                            </p>

                        </div>

                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>