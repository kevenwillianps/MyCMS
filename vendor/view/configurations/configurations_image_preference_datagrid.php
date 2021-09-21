<?php

/** Importação de classes */
use vendor\model\Configurations;

/** Instânciamento de Classes */
$Configurations = new Configurations();

/** Busco a configuração */
$resultConfiguration = $Configurations->All();

/** Decodifico as preferencias */
$resultConfiguration->preferences = (array)json_decode(base64_decode($resultConfiguration->preferences));

?>

<div class="row mt-3 animate slideIn">

    <div class="col-md-6">

        <h5>

            <strong>

                <i class="fas fa-cog mr-1"></i>Configurações

            </strong>

            /Imagens/Listagem/

        </h5>

    </div>

    <div class="col-md-6 text-right">

        <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_IMAGE_PREFERENCE_FORM')">

            <i class="fas fa-plus-circle mr-1"></i>Adicionar

        </button>

    </div>

    <?php

    /** Verifico se existem registros */
    if (count($resultConfiguration->preferences) === 0)
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

        <div class="col-md-12 mt-1">

            <table class="table table-bordered table-borderless table-hover bg-white rounded shadow-sm">

                <thead>

                    <tr>

                        <th scope="col" class="text-center">

                            #

                        </th>

                        <th scope="col">

                            Nome

                        </th>

                        <th scope="col" class="text-center">

                            Largura

                        </th>

                        <th scope="col" class="text-center">

                            Altura

                        </th>

                        <th scope="col" class="text-center">

                            Qualidade

                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php

                /** Listagem de Todos os Registros */
                foreach ($resultConfiguration->preferences as $keyResult => $result)
                { ?>

                    <tr class="border-top">

                        <td class="text-center">

                            <?php echo utf8_encode(@(string)$keyResult)?>

                        </td>

                        <td>

                            <?php echo utf8_encode(@(string)$result->name)?>

                        </td>

                        <td class="text-center">

                            <?php echo utf8_encode(@(int)$result->width)?>

                        </td>

                        <td class="text-center">

                            <?php echo utf8_encode(@(int)$result->height)?>

                        </td>

                        <td class="text-center">

                            <?php echo utf8_encode(@(int)$result->quality)?>

                        </td>

                        <td class="text-center">

                            <div class="btn-group dropleft">

                                <button class="btn btn-primary dropdown-toggle" type="button" id="buttonDropdown_<?php echo utf8_encode($keyResult)?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <i class="fas fa-cog"></i>

                                </button>

                                <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton">

                                    <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_FORM&SITUATION_ID=<?php echo utf8_encode(@(int)$keyResult)?>')">

                                        <span class="badge badge-primary mr-1">

                                            <i class="fas fa-pencil-alt"></i>

                                        </span>

                                        Editar

                                    </a>

                                    <a type="button" class="dropdown-item" onclick="sendForm('#formSituationDelete_<?php echo utf8_encode(@(int)$keyResult)?>')">

                                        <span class="badge badge-danger mr-1">

                                            <i class="fas fa-fire-alt"></i>

                                        </span>

                                        Excluir

                                    </a>

                                </div>

                                <form role="form" id="formSituationDelete_<?php echo utf8_encode(@(int)$keyResult)?>">

                                    <input type="hidden" name="FOLDER" value="ACTION">
                                    <input type="hidden" name="TABLE" value="SITUATIONS">
                                    <input type="hidden" name="ACTION" value="SITUATIONS_DELETE">
                                    <input type="hidden" name="situation_id" value="<?php echo utf8_encode(@(int)$keyResult)?>">

                                </form>

                            </div>

                        </td>

                    </tr>

                <?php }?>

                </tbody>

            </table>

        </div>

    <?php }?>

</div>