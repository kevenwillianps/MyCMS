<?php

    /** Importação de classes */
    use vendor\model\Highlighters;

    /** Instânciamento de Classes */
    $Highlighters = new Highlighters();

    /** Busco o registro */
    $resultHighlighters = $Highlighters->Get(@(int)$_POST['HIGHLIGHTER_ID']);

?>

<div class="row mt-3">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-highlighter mr-1"></i>Marcadores

            </strong>

            /Formulário/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_DATAGRID')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

</div>

<form role="form" id="formSituation" class="card shadow-sm animate slideIn">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="name">

                        Nome:

                    </label>

                    <input type="text" class="form-control" id="name" name="name" value="<?php echo utf8_encode($resultHighlighters->name)?>">

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="description">

                        Descrição:

                    </label>

                    <input type="text" class="form-control" id="description" name="description" value="<?php echo utf8_encode($resultHighlighters->description)?>">

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
    <input type="hidden" name="TABLE" value="HIGHLIGHTERS">
    <input type="hidden" name="ACTION" value="HIGHLIGHTERS_SAVE">
    <input type="hidden" name="highlighter_id" value="<?php echo utf8_encode(@(int)$resultHighlighters->highlighter_id)?>">

</form>

<script type="text/javascript">

    /** Caixa de seleção customizada */
    $('select').selectpicker();

</script>