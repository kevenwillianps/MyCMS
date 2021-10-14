<?php

    /** Importação de classes */
    use vendor\model\Situations;

    /** Instânciamento de Classes */
    $Situations = new Situations();

    /** Busco o registro */
    $resultSituations = $Situations->Get(@(int)$_POST['SITUATION_ID']);

?>

<div class="row mt-3">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-cog mr-1"></i>Situação

            </strong>

            /Formulário/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_DATAGRID')">

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

                    <input type="text" class="form-control" id="name" name="name" value="<?php echo utf8_encode($resultSituations->name)?>">

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="description">

                        Descrição:

                    </label>

                    <input type="text" class="form-control" id="description" name="description" value="<?php echo utf8_encode($resultSituations->description)?>">

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
    <input type="hidden" name="TABLE" value="SITUATIONS">
    <input type="hidden" name="ACTION" value="SITUATIONS_SAVE">
    <input type="hidden" name="situation_id" value="<?php echo utf8_encode(@(int)$resultSituations->situation_id)?>">

</form>

<script type="text/javascript">

    /** Caixa de seleção customizada */
    $('select').selectpicker();

</script>