<?php

/** Importação de classes */
use \vendor\model\Main;
use vendor\model\Contents;
use vendor\model\ContentsSubs;

/** Instânciamento de Classes */
$Main = new Main();
$Contents = new Contents();
$ContentsSubs = new ContentsSubs();

/** Execução de método */
$Main->SessionStart();

/** Busco o registro */
$resultContent = $Contents->Get(@(int)$_POST['CONTENT_ID']);

?>

<div class="row mt-3 animate slideIn">

    <div class="col-md-10">

        <h5>

            <strong>

                <i class="far fa-clipboard mr-1"></i>Conteúdo

            </strong>

            /<?php echo utf8_encode(@(string)$resultContent->title)?>/Vinculados/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=CONTENTS&ACTION=CONTENTS_DATAGRID')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

    <?php

    /** Permissão para criar */
    if (!empty($_SESSION['USER_PERMISSIONS']->contents_subs['create']))
    {?>

        <div class="col-md-2 text-right">

            <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&TABLE=CONTENTS_SUBS&ACTION=CONTENTS_SUBS_FORM&CONTENT_ID=<?php echo utf8_encode(@(int)$resultContent->content_id)?>')">

                <i class="fas fa-plus-circle mr-1"></i>Adicionar

            </button>

        </div>

    <?php }?>

    <?php

    /** Verifico se existem registros */
    if (count($ContentsSubs->All($_POST['CONTENT_ID'])) === 0)
    { ?>

        <div class="col-md-12">

            <div class="alert alert-warning border-warning shadow-sm" role="alert">

                <h4 class="alert-heading">

                    <strong>

                        Ooops!

                    </strong>

                </h4>

                <p>

                    Não foram localizados registros

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

                        <th scope="col">

                            Data de Cadastro

                        </th>

                        <th scope="col" class="text-center">

                            Operações

                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php

                /** Listagem de Todos os Registros */
                foreach ($ContentsSubs->All($_POST['CONTENT_ID']) as $keyResultContentsSubs => $resultContentsSubs)
                { ?>

                    <tr class="border-top">

                        <td class="text-center">

                            <?php echo utf8_encode(@(int)$resultContentsSubs->content_sub_id)?>

                        </td>

                        <td>

                            <?php echo utf8_encode(@(string)$resultContentsSubs->title)?>

                        </td>

                        <td>

                            <?php echo utf8_encode(date('d/m/Y - h:m:s', strtotime(@(string)$resultContentsSubs->date)))?>

                        </td>

                        <td class="text-center">

                            <div class="btn-group dropleft">

                                <button class="btn btn-primary dropdown-toggle" type="button" id="buttonDropdown_<?php echo utf8_encode($keyResultContentsSubs)?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <i class="fas fa-cog"></i>

                                </button>

                                <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton">

                                    <?php

                                    /** Permissão para criar */
                                    if (!empty($_SESSION['USER_PERMISSIONS']->contents_subs['update']))
                                    {?>

                                        <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=CONTENTS_SUBS&ACTION=CONTENTS_SUBS_FORM&CONTENT_SUB_ID=<?php echo utf8_encode(@(int)$resultContentsSubs->content_sub_id)?>&CONTENT_ID=<?php echo utf8_encode(@(int)$resultContentsSubs->content_id)?>')">

                                        <span class="badge badge-primary mr-1">

                                            <i class="fas fa-pencil-alt"></i>

                                        </span>

                                            Editar

                                        </a>

                                    <?php }?>

                                    <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=CONTENTS_SUBS_FILES&ACTION=CONTENTS_SUBS_FILES_DATAGRID&CONTENT_ID=<?php echo utf8_encode(@(int)$resultContentsSubs->content_id)?>&CONTENT_SUB_ID=<?php echo utf8_encode(@(int)$resultContentsSubs->content_sub_id)?>')">

                                        <span class="badge badge-primary mr-1">

                                            <i class="far fa-image"></i>

                                        </span>

                                        Arquivos

                                    </a>

                                    <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=CONTENTS_SUBS&ACTION=CONTENTS_SUBS_DETAIL&CONTENT_SUB_ID=<?php echo utf8_encode(@(int)$resultContentsSubs->content_sub_id)?>&CONTENT_ID=<?php echo utf8_encode(@(int)$resultContentsSubs->content_id)?>')">

                                        <span class="badge badge-primary mr-1">

                                            <i class="far fa-eye"></i>

                                        </span>

                                        Detalhes

                                    </a>

                                    <?php

                                    /** Permissão para criar */
                                    if (!empty($_SESSION['USER_PERMISSIONS']->contents_subs['delete']))
                                    {?>

                                        <a type="button" class="dropdown-item" onclick="sendForm('#formContentsDelete_<?php echo utf8_encode(@(int)$keyResultContentsSubs)?>')">

                                        <span class="badge badge-danger mr-1">

                                            <i class="fas fa-fire-alt"></i>

                                        </span>

                                            Excluir

                                        </a>

                                    <?php }?>

                                </div>

                                <form role="form" id="formContentsDelete_<?php echo utf8_encode(@(int)$keyResultContentsSubs)?>">

                                    <input type="hidden" name="FOLDER" value="ACTION">
                                    <input type="hidden" name="TABLE" value="CONTENTS_SUBS">
                                    <input type="hidden" name="ACTION" value="CONTENTS_SUBS_DELETE">
                                    <input type="hidden" name="content_id" value="<?php echo utf8_encode(@(int)$resultContentsSubs->content_id)?>">
                                    <input type="hidden" name="content_sub_id" value="<?php echo utf8_encode(@(int)$resultContentsSubs->content_sub_id)?>">

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