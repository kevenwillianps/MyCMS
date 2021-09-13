<?php

    /** Importação de classes */
    use vendor\model\Configurations;

    /** Instânciamento de Classes */
    $Configurations = new Configurations();

    /** Busco o registro */
    $resultConfigurations = $Configurations->Get(@(int)$_POST['CONFIGURATION_ID']);

?>

<div class="row animate__animated animate__fadeIn mt-3">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-cog mr-1"></i>Situação

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

            <div class="col-md-3">

                <div class="form-group">

                    <label for="title">

                        Título:

                    </label>

                    <input type="text" class="form-control" id="title" name="title" value="<?php echo utf8_encode(@(string)$resultConfigurations->title)?>">

                </div>

            </div>

            <div class="col-md-3">

                <div class="form-group">

                    <label for="description">

                        Descrição:

                    </label>

                    <input type="text" class="form-control" id="description" name="description" value="<?php echo utf8_encode(@(string)$resultConfigurations->description)?>">

                </div>

            </div>

            <div class="col-md-3">

                <div class="form-group">

                    <label for="author">

                        Autor:

                    </label>

                    <input type="text" class="form-control" id="author" name="author" value="<?php echo utf8_encode(@(string)$resultConfigurations->author)?>">

                </div>

            </div>

            <div class="col-md-3">

                <div class="form-group">

                    <label for="copyright">

                        Copyright:

                    </label>

                    <input type="text" class="form-control" id="copyright" name="copyright" value="<?php echo utf8_encode(@(string)$resultConfigurations->copyright)?>">

                </div>

            </div>

            <div class="col-md-12">

                <div class="form-group">

                    <label for="keywords">

                        Palavras Chaves:

                    </label>

                    <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo utf8_encode(@(string)$resultConfigurations->keywords)?>">

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
    <input type="hidden" name="configuration_id" value="<?php echo utf8_encode(@(int)$resultConfigurations->configuration_id)?>">

</form>