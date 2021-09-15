<?php

    /** Importação de classes */
    use vendor\model\Situations;
    use vendor\model\Contents;
    use vendor\model\ContentCategories;
    use vendor\model\Highlighters;

    /** Instânciamento de Classes */
    $Situations = new Situations();
    $Contents = new Contents();
    $ContentCategories = new ContentCategories();
    $Highlighters = new Highlighters();

    /** Busco o registro */
    $resultContent = $Contents->Get(@(int)$_POST['CONTENT_ID']);

?>

<div class="row animate slideIn">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="far fa-clipboard mr-1"></i>Conteúdo

            </strong>

            /Formulário/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=CONTENTS&ACTION=CONTENTS_DATAGRID')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

</div>

<form role="form" id="formSituation" class="card shadow-sm animate slideIn">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">

                <div class="form-group">

                    <label for="content_category_id">

                        Categoria:

                    </label>

                    <select name="content_category_id" id="content_category_id" class="form-control custom-select border" data-live-search="true" data-size="5">

                        <option data-tokens="Selecione" value="0">

                            Selecione...

                        </option>

                        <?php

                        /** Listagem de Registros */
                        foreach ($ContentCategories->All() as $keyResultContentCategories => $resultContentCategories)
                        { ?>

                            <option data-tokens="<?php echo utf8_encode(@(string)$resultContentCategories->name)?>" value="<?php echo utf8_encode(@(int)$resultContentCategories->content_category_id)?>" <?php echo utf8_encode(@(int)$resultContentCategories->content_category_id === @(int)$resultContent->content_category_id) ? 'selected' : null?>>

                                <?php echo utf8_encode(@(string)$resultContentCategories->name)?>

                            </option>

                        <?php }?>

                    </select>

                </div>

            </div>

            <div class="col-md-4">

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

            <div class="col-md-4">

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

            <div class="col-md-4">

                <div class="form-group">

                    <label for="position_menu">

                        Posição no Menu:

                    </label>

                    <input type="number" class="form-control" id="position_menu" name="position_menu" value="<?php echo utf8_encode(@(int)$resultContent->position_menu)?>">

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label for="position_content">

                        Posição do Conteúdo:

                    </label>

                    <input type="number" class="form-control" id="position_content" name="position_content" value="<?php echo utf8_encode(@(int)$resultContent->position_content)?>">

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label for="url">

                        URL para acesso externo:

                    </label>

                    <input type="text" class="form-control" id="url" name="url" value="<?php echo utf8_encode(@(string)$resultContent->url)?>">

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="title">

                        Título:

                    </label>

                    <input type="text" class="form-control" id="title" name="title" value="<?php echo utf8_encode(@(string)$resultContent->title)?>">

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="title_menu">

                        Título do Menu:

                    </label>

                    <input type="text" class="form-control" id="title_menu" name="title_menu" value="<?php echo utf8_encode(@(string)$resultContent->title_menu)?>">

                </div>

            </div>

            <div class="col-md-12">

                <div class="form-group">

                    <label for="description">

                        Descrição:

                    </label>

                    <input type="text" class="form-control" id="description" name="description" value="<?php echo utf8_encode(@(string)$resultContent->description)?>">

                </div>

            </div>

            <div class="col-md-12">

                <div class="form-group">

                    <label for="content_resume">

                        Conteúdo Resumido:

                    </label>

                    <input type="text" class="form-control" id="content_resume" name="content_resume" value="<?php echo utf8_encode(@(string)$resultContent->content_resume)?>">

                </div>

            </div>

            <div class="col-md-12">

                <div class="form-group">

                    <label for="content_complete">

                        Conteúdo Completo:

                    </label>

                    <div id="content_complete" class="border editor">

                        <?php echo utf8_encode(@(string)$resultContent->content_complete)?>

                    </div>

                </div>

            </div>

            <div class="col-md-12">

                <div class="form-group">

                    <label for="keywords">

                        Palavras Chaves:

                    </label>

                    <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo utf8_encode(@(string)$resultContent->keywords)?>">

                </div>

            </div>

        </div>

        <div class="form-group mb-0 text-right">

            <button type="button" class="btn btn-primary" onclick="sendForm('#formSituation', 'S')">

                <i class="far fa-save mr-1"></i>Salvar

            </button>

        </div>

    </div>

    <input type="hidden" name="FOLDER" value="ACTION">
    <input type="hidden" name="TABLE" value="CONTENTS">
    <input type="hidden" name="ACTION" value="CONTENTS_SAVE">
    <input type="hidden" name="content_id" value="<?php echo utf8_encode(@(int)$resultContent->content_id)?>">

</form>

<script type="text/javascript">

    /** Caixa de seleção customizada */
    $('select').selectpicker();

    /** Carregamento de mascara */
    loadCkeditor();

</script>