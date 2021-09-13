<?php

    /** Importação de classes */
    use \vendor\model\GUsuario;

    /** Instânciamento de classes */
    $GUsuario = new GUsuario();

    /** Busco o Registro especifico */
    $resultGUsuario = $GUsuario->Get(@(int)$_POST['USUARIO_ID']);

    /** Verifico o tipo de operação */
    $action = @(int)$resultGUsuario->USUARIO_ID === 0 ? 0 : 1;

?>

<div class="row animate__animated animate__fadeIn">

    <div class="col-md-12">

        <h4 class="card-title">

            <strong>

                <i class="fas fa-cog mr-1"></i>Administração

            </strong>

            /Usuários/Formulário/Foto/

            <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&PRODUCT=GR&TABLE=GUSUARIO&ACTION=G_USUARIO_DATAGRID')">

                <i class="fas fa-angle-left mr-1"></i>Voltar

            </button>

        </h4>

    </div>

    <div class="col-md-12">

        <div class="card shadow-sm animate slideIn">

            <form class="card-body" role="form" id="formGUsuarioFileForm">

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="file" class="text-semi-bold">

                                Foto de Perfil

                            </label>

                            <div class="custom-file">

                                <input type="file" class="custom-file-input" id="file" onchange="prepareUploadFile('#file')" accept="image/png, image/jpeg, image/jpg">

                                <label class="custom-file-label" for="file" data-browse="Buscar">

                                    Voeg je document toe

                                </label>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12 text-right">

                        <button type="button" class="btn btn-primary" onclick="prepareForm('#formGUsuarioFileForm')">

                            <i class="far fa-paper-plane mr-1"></i>Salvar

                        </button>

                    </div>

                </div>

                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="PRODUCT" value="GR"/>
                <input type="hidden" name="usuario_id" value="<?php echo utf8_encode(@(int)$resultGUsuario->USUARIO_ID)?>"/>
                <input type="hidden" name="TABLE" value="GUSUARIO"/>
                <input type="hidden" name="ACTION" value="G_USUARIO_FILE_SAVE"/>


            </form>

        </div>

    </div>

</div>