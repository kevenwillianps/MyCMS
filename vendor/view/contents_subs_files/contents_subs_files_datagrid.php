<?php

/** Importação de classes */
use vendor\model\ContentsSubs;
use vendor\model\ContentsSubsFiles;

/** Instânciamento de Classes */
$ContentsSubs = new ContentsSubs();
$ContentsSubsFiles = new ContentsSubsFiles();

/** Busco o registro */
$resultContentSub = $ContentsSubs->Get(@(int)$_POST['CONTENT_SUB_ID']);

?>

<div class="row mt-3 animate slideIn">

    <div class="col-md-10">

        <h5>

            <strong>

                <i class="far fa-clipboard mr-1"></i>Conteúdo

            </strong>

            /Vinculados/<?php echo utf8_encode(@(string)$resultContentSub->title)?>/Arquivos/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=CONTENTS_SUBS&ACTION=CONTENTS_SUBS_DATAGRID&CONTENT_ID=<?php echo utf8_encode(@(int)$resultContentSub->content_id)?>')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-2 text-right">

        <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&TABLE=CONTENTS_SUBS_FILES&ACTION=CONTENTS_SUBS_FILES_FORM&CONTENT_ID=<?php echo utf8_encode(@(int)$resultContentSub->content_id)?>&CONTENT_SUB_ID=<?php echo utf8_encode(@(int)$resultContentSub->content_sub_id)?>')">

            <i class="fas fa-plus-circle mr-1"></i>Adicionar

        </button>

    </div>

    <?php

    /** Verifico se existem registros */
    if (count($ContentsSubsFiles->All($_POST['CONTENT_SUB_ID'])) === 0)
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

        <?php

        /** Listagem de Todos os Registros */
        foreach ($ContentsSubsFiles->All($_POST['CONTENT_SUB_ID']) as $keyResultContentsSubsFiles => $resultContentsSubsFiles)
        { ?>

            <div class="col-md-2">

                <form role="form" id="formContentFileDelete_<?php echo utf8_encode(@(int)$keyResultContentsSubsFiles)?>" class="card shadow-sm">

                    <img src="<?php echo utf8_encode(@(string)$resultContentsSubsFiles->path)?>/<?php echo utf8_encode(@(string)$resultContentsSubsFiles->name)?>" class="card-img-top" title="<?php echo utf8_encode(@(string)$resultContentsSubsFiles->name)?>" alt="<?php echo utf8_encode(@(string)$resultContentsSubsFiles->name)?>">

                    <div class="card-body">

                        <h6 class="card-title mb-1">

                            Marcador:

                        </h6>

                        <h5 class="card-subtitle mb-2">

                            <?php echo utf8_encode(@(string)$resultContentsSubsFiles->description)?>

                        </h5>

                        <a href="#" class="btn btn-danger btn-block" onclick="sendForm('#formContentFileDelete_<?php echo utf8_encode(@(int)$keyResultContentsSubsFiles)?>')">

                            <i class="fas fa-fire-alt mr-1"></i> Excluir

                        </a>

                    </div>

                    <input type="hidden" name="FOLDER" value="ACTION">
                    <input type="hidden" name="TABLE" value="CONTENTS_SUBS_FILES">
                    <input type="hidden" name="ACTION" value="CONTENTS_SUBS_FILES_DELETE">
                    <input type="hidden" name="content_sub_id" value="<?php echo utf8_encode(@(int)$resultContentsSubsFiles->content_sub_id)?>">
                    <input type="hidden" name="content_sub_file_id" value="<?php echo utf8_encode(@(int)$resultContentsSubsFiles->content_sub_file_id)?>">

                </form>

            </div>

        <?php }?>

    <?php }?>

</div>