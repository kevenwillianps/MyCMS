<?php

/** Importação de classes */
use vendor\model\Situations;
use vendor\model\Highlighters;
use \vendor\model\Contents;
use \vendor\model\ContentsFiles;
use \vendor\controller\contents_files\ContentsFilesValidade;

/** Instânciamento de classes */
$Situations = new Situations();
$Highlighters = new Highlighters();
$Contents = new Contents();
$ContentsFiles = new ContentsFiles();
$ContentsFilesValidade = new ContentsFilesValidade();

/** Busco o registro */
$resultContent = $Contents->Get(@(int)$_POST['CONTENT_ID']);

?>

<div class="row animate__animated animate__fadeIn">

    <div class="col-md-10">

        <h5>

            <strong>

                <i class="far fa-clipboard mr-1"></i>Conteúdo

            </strong>

            /<?php echo utf8_encode(@(string)$resultContent->title)?>/Arquivos/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=CONTENTS&ACTION=CONTENTS_DATAGRID')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-12">

        <div class="card shadow-sm animate slideIn">

            <form class="card-body" role="form" id="formContentFiles">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="situation_id">

                                Situação:

                            </label>

                            <select name="situation_id" id="situation_id" class="form-control custom-select border" data-live-search="true" data-size="5">

                                <option data-tokens="Selecione" value="0">

                                    Selecione...

                                </option>

                                <?php

                                /** Listagem de Registros */
                                foreach ($Situations->All() as $keyResultSituation => $resultSituation)
                                { ?>

                                    <option data-tokens="<?php echo utf8_encode(@(string)$resultSituation->name)?>" value="<?php echo utf8_encode(@(int)$resultSituation->situation_id)?>" <?php echo utf8_encode(@(int)$resultSituation->situation_id === @(int)$resultContent->situation_id) ? 'selected' : null?>>

                                        <?php echo utf8_encode(@(string)$resultSituation->name)?>

                                    </option>

                                <?php }?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="highlighter_id">

                                Marcador:

                            </label>

                            <select name="highlighter_id" id="highlighter_id" class="form-control custom-select border" data-live-search="true" data-size="5">

                                <option data-tokens="Selecione" value="0">

                                    Selecione...

                                </option>

                                <?php

                                /** Listagem de Registros */
                                foreach ($Highlighters->All() as $keyResultHighlighter => $resultHighlighter)
                                { ?>

                                    <option data-tokens="<?php echo utf8_encode(@(string)$resultHighlighter->name)?>" value="<?php echo utf8_encode(@(int)$resultHighlighter->highlighter_id)?>" <?php echo utf8_encode(@(int)$resultHighlighter->highlighter_id === @(int)$resultContent->highlighter_id) ? 'selected' : null?>>

                                        <?php echo utf8_encode(@(string)$resultHighlighter->description)?>

                                    </option>

                                <?php }?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="file" class="text-semi-bold">

                                Arquivo

                            </label>

                            <div class="custom-file">

                                <input type="file" class="custom-file-input" id="file" name="file" onchange="prepareUploadFile('#file')" accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">

                                    Choose file

                                </label>

                            </div>

                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-primary" onclick="prepareForm('#formContentFiles')">

                    <i class="far fa-paper-plane mr-1"></i>Salvar

                </button>

                <input type="hidden" name="content_id" value="<?php echo utf8_encode($_POST['CONTENT_ID'])?>"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="CONTENTS_FILES"/>
                <input type="hidden" name="ACTION" value="CONTENTS_FILES_SAVE"/>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {

        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

    });

</script>