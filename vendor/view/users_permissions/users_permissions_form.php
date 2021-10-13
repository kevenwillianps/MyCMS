<?php

    /** Importação de classes */
    use vendor\model\UsersPermissions;

    /** Instânciamento de Classes */
    $UsersPermissions = new UsersPermissions();

    /** Busco o registro */
    $resultUerPermission = $UsersPermissions->Get(@(int)$_POST['USER_PERMISSION_ID']);

?>

<div class="row animate__animated animate__fadeIn mt-3">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-cog mr-1"></i>Permissões

            </strong>

            /Formulário/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=USERS_PERMISSIONS&ACTION=USERS_PERMISSIONS_DATAGRID')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

</div>

<form role="form" id="formUserPermission" class="card shadow-sm animate slideIn">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="name">

                        Nome:

                    </label>

                    <input type="text" class="form-control" id="name" name="name" value="<?php echo utf8_encode($resultUerPermission->name)?>">

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="description">

                        Descrição:

                    </label>

                    <input type="text" class="form-control" id="description" name="description" value="<?php echo utf8_encode($resultUerPermission->description)?>">

                </div>

            </div>

        </div>

        <h5 class="card-title">

            Permissões

        </h5>

        <div class="row">

            <div class="col-md-3">

                <h6 class="card-subtitle">

                    <i class="far fa-clipboard mr-1"></i>Conteúdo

                </h6>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_read" name="contents_read">
                    <label class="custom-control-label" for="contents_read">

                        Listagem

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_create" name="contents_create">
                    <label class="custom-control-label" for="contents_create">

                        Criar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_update" name="contents_update">
                    <label class="custom-control-label" for="contents_update">

                        Editar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_delete" name="contents_delete">
                    <label class="custom-control-label" for="contents_delete">

                        Excluir

                    </label>

                </div>

            </div>

        </div>

        <div class="form-group mb-0 text-right">

            <button type="button" class="btn btn-primary" onclick="sendForm('#formUserPermission')">

                <i class="far fa-save mr-1"></i>Salvar

            </button>

        </div>

    </div>

    <input type="hidden" name="FOLDER" value="ACTION">
    <input type="hidden" name="TABLE" value="USERS_PERMISSIONS">
    <input type="hidden" name="ACTION" value="USERS_PERMISSIONS_SAVE">
    <input type="hidden" name="user_permission_id" value="<?php echo utf8_encode(@(int)$resultUerPermission->user_permission_id)?>">

</form>