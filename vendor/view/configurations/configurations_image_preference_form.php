<?php

    /** Importação de classes */
    use vendor\model\Configurations;

    /** Instânciamento de Classes */
    $Configurations = new Configurations();

    /** Busco a configuração */
    $resultConfiguration = $Configurations->All();

    /** Decodifico as preferencias */
    $resultConfiguration->preferences = (object)json_decode(base64_decode($resultConfiguration->preferences));

?>

<div class="row mt-3">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-cog mr-1"></i>Configurações

            </strong>

            /Imagens/Formulário/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_IMAGE_PREFERENCE_DATAGRID')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

</div>

<form role="form" id="formConfigurations" class="card shadow-sm animate slideIn">

    <div class="card-body">

        <div class="row">

            <div class="col-md">

                <div class="form-group">

                    <label for="name">

                        Nome:

                    </label>

                    <input type="text" class="form-control" id="name" name="name" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->name)?>">

                </div>

            </div>

            <div class="col-md">

                <div class="form-group">

                    <label for="width">

                        Largura:

                    </label>

                    <input type="number" class="form-control" id="width" name="width" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->width)?>">

                </div>

            </div>

            <div class="col-md">

                <div class="form-group">

                    <label for="height">

                        Altura

                    </label>

                    <input type="number" class="form-control" id="height" name="height" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->height)?>">

                </div>

            </div>

            <div class="col-md">

                <div class="form-group">

                    <label for="quality_jpg">

                        Qualidade <strong>JPG</strong>:

                    </label>

                    <input type="number" class="form-control" id="quality_jpg" name="quality_jpg" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->quality_jpg)?>">

                </div>

            </div>

            <div class="col-md">

                <div class="form-group">

                    <label for="quality_png">

                        Qualidade <strong>PNG</strong>:

                    </label>

                    <input type="number" class="form-control" id="quality_png" name="quality_png" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->quality_png)?>">

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
    <input type="hidden" name="ACTION" value="CONFIGURATIONS_IMAGE_PREFERENCE_SAVE">
    <input type="hidden" name="indice" value="<?php echo utf8_encode(@(int)$resultConfiguration->configuration_id)?>">
    <input type="hidden" name="configuration_id" value="<?php echo utf8_encode(@(int)$resultConfiguration->configuration_id)?>">

</form>

<script type="text/javascript">

    /** Caixa de seleção customizada */
    $('select').selectpicker();

</script>