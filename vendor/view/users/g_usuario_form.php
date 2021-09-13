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

<div class="row animate__animated animate__fadeIn mt-3">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-certificate mr-1"></i>Administração/

            </strong>

            Usuários/Formulário/

            <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&PRODUCT=GR&TABLE=GUSUARIO&ACTION=G_USUARIO_DATAGRID')">

                <i class="fas fa-angle-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

</div>

<div class="row animate slideIn">

    <div class="col-md-12">

        <div class="card shadow-sm">

            <div class="card-body mb-0">

                <form role="form" id="formGUsuario" class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="nome_completo">

                                Nome

                            </label>

                            <input type="text" class="form-control" value="<?php echo utf8_encode(@(string)$resultGUsuario->NOME_COMPLETO)?>" name="nome_completo" id="nome_completo">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="login">

                                Login

                            </label>

                            <input type="text" class="form-control" value="<?php echo utf8_encode(@(string)$resultGUsuario->LOGIN)?>" name="login" id="login">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="cpf">

                                CPF

                            </label>

                            <input type="text" class="form-control" value="<?php echo utf8_encode(@(string)$resultGUsuario->CPF)?>" name="cpf" id="cpf">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="funcao">

                                Função

                            </label>

                            <input type="text" class="form-control" value="<?php echo utf8_encode(@(string)$resultGUsuario->FUNCAO)?>" name="funcao" id="funcao">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="situacao">

                                Situação

                            </label>

                            <select name="situacao" id="situacao" class="form-control custom-select border" data-live-search="true">

                                <option value="A" <?php echo utf8_encode(@(string)$resultGUsuario->SITUACAO === 'A' ? 'selected' : null)?>>

                                    Ativo

                                </option>

                                <option value="I" <?php echo utf8_encode(@(string)$resultGUsuario->SITUACAO === 'I' ? 'selected' : null)?>>

                                    Inativo

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-12 text-right">

                        <div class="form-group">

                            <button type="button" class="btn btn-primary" onclick="sendForm('#formGUsuario')">

                                Salvar

                            </button>

                        </div>

                    </div>

                    <input type="hidden" name="FOLDER" value="ACTION"/>
                    <input type="hidden" name="PRODUCT" value="GR"/>
                    <input type="hidden" name="usuario_id" value="<?php echo utf8_encode(@(int)$resultGUsuario->USUARIO_ID)?>"/>
                    <input type="hidden" name="CONDITION" value="<?php echo utf8_encode(@(int)$action)?>"/>
                    <input type="hidden" name="TABLE" value="GUSUARIO"/>
                    <input type="hidden" name="ACTION" value="G_USUARIO_SAVE"/>

                </form>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">

    // To style all selects
    $('select').selectpicker();

</script>

