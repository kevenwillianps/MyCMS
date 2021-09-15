<?php

    /** Importação de classes */
    use vendor\model\Configurations;

    /** Instânciamento de Classes */
    $Configurations = new Configurations();

    /** Busco o registro */
    $resultConfiguration = $Configurations->Get(@(int)$_POST['CONFIGURATION_ID']);

?>

<div class="row mt-3">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-cog mr-1"></i>Configurações

            </strong>

            /Formulário/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_DATAGRID')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

</div>

<form role="form" id="formConfigurations" class="card shadow-sm animate slideIn">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">

                <div class="form-group">

                    <label for="title">

                        Título:

                    </label>

                    <input type="text" class="form-control" id="title" name="title" value="<?php echo utf8_encode($resultConfiguration->title)?>">

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label for="copyright">

                        Copyright:

                    </label>

                    <input type="text" class="form-control" id="copyright" name="copyright" value="<?php echo utf8_encode($resultConfiguration->copyright)?>">

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label for="author">

                        Autor:

                    </label>

                    <input type="text" class="form-control" id="author" name="author" value="<?php echo utf8_encode($resultConfiguration->author)?>">

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="description">

                        Descrição:

                    </label>

                    <input type="text" class="form-control" id="description" name="description" value="<?php echo utf8_encode($resultConfiguration->description)?>">

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="keywords">

                        Palavras Chaves:

                    </label>

                    <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo utf8_encode($resultConfiguration->keywords)?>">

                </div>

            </div>

        </div>

        <div class="form-group mb-0 text-right">

            <button type="button" class="btn btn-primary" onclick="sendForm('#formConfigurations')">

                <i class="far fa-save mr-1"></i>Salvar

            </button>

        </div>

    </div>

    <input type="hidden" name="FOLDER" value="ACTION">
    <input type="hidden" name="TABLE" value="CONFIGURATIONS">
    <input type="hidden" name="ACTION" value="CONFIGURATIONS_SAVE">
    <input type="hidden" name="configuration_id" value="<?php echo utf8_encode(@(int)$resultConfiguration->configuration_id)?>">

</form>

<script type="text/javascript">

    /** Caixa de seleção customizada */
    $('select').selectpicker();

</script>