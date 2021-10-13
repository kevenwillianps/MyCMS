<?php

    /** Importação de classes */
    use vendor\model\Users;
    use vendor\model\UsersPermissions;

    /** Instânciamento de Classes */
    $Users = new Users();
    $UsersPermissions = new UsersPermissions();

    /** Busco o registro */
    $resultUsers = $Users->Get(@(int)filter_input(INPUT_POST, 'USER_ID', FILTER_SANITIZE_STRING));

?>

<div class="row mt-3">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-cog mr-1"></i>Usuários

            </strong>

            /Formulário/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_DATAGRID')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

</div>

<form role="form" id="formUsers" class="card shadow-sm animate slideIn">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">

                <div class="form-group">

                    <label for="name_first">

                        Primero Nome:

                    </label>

                    <input type="text" class="form-control" id="name_first" name="name_first" value="<?php echo utf8_encode(@(string)$resultUsers->name_first)?>">

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label for="name_last">

                        Último Nome:

                    </label>

                    <input type="text" class="form-control" id="name_last" name="name_last" value="<?php echo utf8_encode(@(string)$resultUsers->name_last)?>">

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label for="date_birth">

                        Data de Nascimento:

                    </label>

                    <input type="date" class="form-control" id="date_birth" name="date_birth" value="<?php echo utf8_encode(@(string)$resultUsers->date_birth)?>">

                </div>

            </div>

            <div class="col-md-9">

                <div class="form-group">

                    <label for="email">

                        Email:

                    </label>

                    <input type="email" class="form-control" id="email" name="email" value="<?php echo utf8_encode(@(string)$resultUsers->email)?>">

                </div>

            </div>

            <div class="col-md-3">

                <div class="form-group">

                    <label for="password">

                        Senha:

                    </label>

                    <input type="password" class="form-control" id="password" name="password">

                </div>

            </div>

            <div class="col-md-12">

                <div class="form-group">

                    <label for="user_permission_id">

                        Permissão:

                    </label>

                    <select name="user_permission_id" id="user_permission_id" class="form-control custom-select border" data-live-search="true" data-size="5">

                        <option data-tokens="Selecione" value="0">

                            Selecione...

                        </option>

                        <?php

                        /** Listagem de Registros */
                        foreach ($UsersPermissions->All() as $keyResultUsersPermissions => $resultUsersPermissions)
                        { ?>

                            <option data-tokens="<?php echo utf8_encode(@(string)$resultUsersPermissions->name)?>" value="<?php echo utf8_encode(@(int)$resultUsersPermissions->user_permission_id)?>" <?php echo utf8_encode(@(int)$resultUsersPermissions->user_permission_id === @(int)$resultUsers->user_permission_id) ? 'selected' : null?>>

                                <?php echo utf8_encode(@(string)$resultUsersPermissions->name)?> - <?php echo utf8_encode(@(string)$resultUsersPermissions->description)?>

                            </option>

                        <?php }?>

                    </select>

                </div>

            </div>

        </div>

        <div class="form-group mb-0 text-right">

            <button type="button" class="btn btn-primary" onclick="sendForm('#formUsers')">

                <i class="far fa-save mr-1"></i>Salvar

            </button>

        </div>

    </div>

    <input type="hidden" name="FOLDER" value="ACTION">
    <input type="hidden" name="TABLE" value="USERS">
    <input type="hidden" name="ACTION" value="USERS_SAVE">
    <input type="hidden" name="user_id" value="<?php echo utf8_encode(@(int)$resultUsers->user_id)?>">

</form>

<script type="text/javascript">

    /** Caixa de seleção customizada */
    $('select').selectpicker();

</script>