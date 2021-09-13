<?php

/** Importação de classes */
use vendor\model\Contents;
use vendor\model\ContentsFiles;

/** Instânciamento de Classes */
$Contents = new Contents();
$ContentsFiles = new ContentsFiles();

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

    <div class="col-md-2 text-right">

        <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&TABLE=CONTENTS_FILES&ACTION=CONTENTS_FILES_FORM&CONTENT_ID=<?php echo utf8_encode(@(int)$resultContent->content_id)?>')">

            <i class="fas fa-plus-circle mr-1"></i>Adicionar

        </button>

    </div>

    <?php

    /** Verifico se existem registros */
    if (count($ContentsFiles->All($_POST['CONTENT_ID'])) === 0)
    { ?>

        <div class="col-md-2 mx-auto mt-3">

            <img src="image/desert.svg" alt="" class="img-fluid">

        </div>

    <?php }else{ ?>

        <?php

        /** Listagem de Todos os Registros */
        foreach ($ContentsFiles->All($_POST['CONTENT_ID']) as $keyResultContentsFiles => $resultContentsFiles)
        { ?>

            <div class="col-md-2">

                <form role="form" id="formContentFileDelete_<?php echo utf8_encode(@(int)$keyResultContentsFiles)?>" class="card shadow-sm">

                    <img src="<?php echo utf8_encode(@(string)$resultContentsFiles->path)?>" class="card-img-top" alt="...">

                    <div class="card-body">

                        <h6 class="card-title mb-1">

                            Marcador:

                        </h6>

                        <h5 class="card-subtitle mb-2">

                            <?php echo utf8_encode(@(string)$resultContentsFiles->description)?>

                        </h5>

                        <a href="#" class="btn btn-danger btn-block" onclick="sendForm('#formContentFileDelete_<?php echo utf8_encode(@(int)$keyResultContentsFiles)?>')">

                            <i class="fas fa-fire-alt mr-1"></i> Excluir

                        </a>

                    </div>

                    <input type="hidden" name="FOLDER" value="ACTION">
                    <input type="hidden" name="TABLE" value="CONTENTS_FILES">
                    <input type="hidden" name="ACTION" value="CONTENTS_FILES_DELETE">
                    <input type="hidden" name="content_id" value="<?php echo utf8_encode(@(int)$resultContentsFiles->content_id)?>">
                    <input type="hidden" name="content_file_id" value="<?php echo utf8_encode(@(int)$resultContentsFiles->content_file_id)?>">

                </form>

            </div>

        <?php }?>

    <?php }?>

</div>