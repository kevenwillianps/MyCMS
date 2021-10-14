<?php

    /** Importação de classes */
    use vendor\model\Situations;
    use vendor\model\ContentCategories;

    /** Instânciamento de Classes */
    $Situations = new Situations();
    $ContentCategories = new ContentCategories();

    /** Busco o registro */
    $resultContentCategory = $ContentCategories->Get(@(int)$_POST['CONTENT_CATEGORY_ID']);

?>

<div class="row mt-3">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-cog mr-1"></i>Categoria

            </strong>

            /Formulário/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=CONTENT_CATEGORIES&ACTION=CONTENT_CATEGORIES_DATAGRID')">

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

                            <option data-tokens="<?php echo utf8_encode(@(string)$resultSituation->name)?>" value="<?php echo utf8_encode(@(int)$resultSituation->situation_id)?>" <?php echo utf8_encode(@(int)$resultSituation->situation_id === @(int)$resultContentCategory->situation_id) ? 'selected' : null?>>

                                <?php echo utf8_encode(@(string)$resultSituation->name)?>

                            </option>

                        <?php }?>

                    </select>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label for="name">

                        Nome:

                    </label>

                    <input type="text" class="form-control" id="name" name="name" value="<?php echo utf8_encode($resultContentCategory->name)?>">

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label for="description">

                        Descrição:

                    </label>

                    <input type="text" class="form-control" id="description" name="description" value="<?php echo utf8_encode($resultContentCategory->description)?>">

                </div>

            </div>

        </div>

        <div class="form-group mb-0 text-right">

            <button type="button" class="btn btn-primary" onclick="sendForm('#formSituation')">

                <i class="far fa-save mr-1"></i>Salvar

            </button>

        </div>

    </div>

    <input type="hidden" name="FOLDER" value="ACTION">
    <input type="hidden" name="TABLE" value="CONTENT_CATEGORIES">
    <input type="hidden" name="ACTION" value="CONTENT_CATEGORIES_SAVE">
    <input type="hidden" name="content_category_id" value="<?php echo utf8_encode(@(int)$resultContentCategory->content_category_id)?>">

</form>

<script type="text/javascript">

    /** Caixa de seleção customizada */
    $('select').selectpicker();

</script>