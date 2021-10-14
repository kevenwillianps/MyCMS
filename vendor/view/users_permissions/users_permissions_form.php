<?php

    /** Importação de classes */
    use vendor\model\UsersPermissions;

    /** Instânciamento de Classes */
    $UsersPermissions = new UsersPermissions();

    /** Busco o registro */
    $resultUerPermission = $UsersPermissions->Get(@(int)$_POST['USER_PERMISSION_ID']);
    $resultUerPermission->permissions = (object)json_decode(base64_decode($resultUerPermission->permissions), true);

?>

<div class="row mt-3">

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

                    <i class="fas fa-cog mr-1"></i>Configurações

                </h6>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="configurations_read" name="configurations_read" <?php echo utf8_encode(!empty($resultUerPermission->permissions->configurations['read']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="configurations_read">

                        Listagem

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="configurations_create" name="configurations_create" <?php echo utf8_encode(!empty($resultUerPermission->permissions->configurations['create']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="configurations_create">

                        Criar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="configurations_update" name="configurations_update" <?php echo utf8_encode(!empty($resultUerPermission->permissions->configurations['update']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="configurations_update">

                        Editar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="configurations_delete" name="configurations_delete" <?php echo utf8_encode(!empty($resultUerPermission->permissions->configurations['delete']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="configurations_delete">

                        Excluir

                    </label>

                </div>

            </div>

            <div class="col-md-3">

                <h6 class="card-subtitle">

                    <i class="fas fa-lock mr-1"></i>Permissões

                </h6>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="users_permissions_read" name="users_permissions_read" <?php echo utf8_encode(!empty($resultUerPermission->permissions->users_permissions['read']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="users_permissions_read">

                        Listagem

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="users_permissions_create" name="users_permissions_create" <?php echo utf8_encode(!empty($resultUerPermission->permissions->users_permissions['create']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="users_permissions_create">

                        Criar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="users_permissions_update" name="users_permissions_update" <?php echo utf8_encode(!empty($resultUerPermission->permissions->users_permissions['update']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="users_permissions_update">

                        Editar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="users_permissions_delete" name="users_permissions_delete" <?php echo utf8_encode(!empty($resultUerPermission->permissions->users_permissions['delete']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="users_permissions_delete">

                        Excluir

                    </label>

                </div>

            </div>

            <div class="col-md-3">

                <h6 class="card-subtitle">

                    <i class="fas fa-users mr-1"></i>Usuários

                </h6>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="users_read" name="users_read" <?php echo utf8_encode(!empty($resultUerPermission->permissions->users['read']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="users_read">

                        Listagem

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="users_create" name="users_create" <?php echo utf8_encode(!empty($resultUerPermission->permissions->users['create']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="users_create">

                        Criar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="users_update" name="users_update" <?php echo utf8_encode(!empty($resultUerPermission->permissions->users['update']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="users_update">

                        Editar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="users_delete" name="users_delete" <?php echo utf8_encode(!empty($resultUerPermission->permissions->users['delete']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="users_delete">

                        Excluir

                    </label>

                </div>

            </div>

            <div class="col-md-3">

                <h6 class="card-subtitle">

                    <i class="fas fa-cog mr-1"></i>Situação

                </h6>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="situations_read" name="situations_read" <?php echo utf8_encode(!empty($resultUerPermission->permissions->situations['read']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="situations_read">

                        Listagem

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="situations_create" name="situations_create" <?php echo utf8_encode(!empty($resultUerPermission->permissions->situations['create']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="situations_create">

                        Criar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="situations_update" name="situations_update" <?php echo utf8_encode(!empty($resultUerPermission->permissions->situations['update']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="situations_update">

                        Editar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="situations_delete" name="situations_delete" <?php echo utf8_encode(!empty($resultUerPermission->permissions->situations['delete']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="situations_delete">

                        Excluir

                    </label>

                </div>

            </div>

            <div class="col-md-3 mt-3">

                <h6 class="card-subtitle">

                    <i class="fas fa-highlighter mr-1"></i>Marcadores

                </h6>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="highlighters_read" name="highlighters_read" <?php echo utf8_encode(!empty($resultUerPermission->permissions->highlighters['read']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="highlighters_read">

                        Listagem

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="highlighters_create" name="highlighters_create" <?php echo utf8_encode(!empty($resultUerPermission->permissions->highlighters['create']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="highlighters_create">

                        Criar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="highlighters_update" name="highlighters_update" <?php echo utf8_encode(!empty($resultUerPermission->permissions->highlighters['update']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="highlighters_update">

                        Editar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="highlighters_delete" name="highlighters_delete" <?php echo utf8_encode(!empty($resultUerPermission->permissions->highlighters['delete']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="highlighters_delete">

                        Excluir

                    </label>

                </div>

            </div>

            <div class="col-md-3 mt-3">

                <h6 class="card-subtitle">

                    <i class="fas fa-filter mr-1"></i>Categoria

                </h6>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="content_categories_read" name="content_categories_read" <?php echo utf8_encode(!empty($resultUerPermission->permissions->content_categories['read']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="content_categories_read">

                        Listagem

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="content_categories_create" name="content_categories_create" <?php echo utf8_encode(!empty($resultUerPermission->permissions->content_categories['create']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="content_categories_create">

                        Criar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="content_categories_update" name="content_categories_update" <?php echo utf8_encode(!empty($resultUerPermission->permissions->content_categories['update']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="content_categories_update">

                        Editar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="content_categories_delete" name="content_categories_delete" <?php echo utf8_encode(!empty($resultUerPermission->permissions->content_categories['delete']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="content_categories_delete">

                        Excluir

                    </label>

                </div>

            </div>

            <div class="col-md-3 mt-3">

                <h6 class="card-subtitle">

                    <i class="far fa-clipboard mr-1"></i>Conteúdo

                </h6>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_read" name="contents_read" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contents['read']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contents_read">

                        Listagem

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_create" name="contents_create" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contents['create']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contents_create">

                        Criar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_update" name="contents_update" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contents['update']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contents_update">

                        Editar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_delete" name="contents_delete" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contents['delete']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contents_delete">

                        Excluir

                    </label>

                </div>

            </div>

            <div class="col-md-3 mt-3">

                <h6 class="card-subtitle">

                    <i class="fas fa-link mr-1"></i>Conteúdo Vinculados

                </h6>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_subs_read" name="contents_subs_read" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contents_subs['read']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contents_subs_read">

                        Listagem

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_subs_create" name="contents_subs_create" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contents_subs['create']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contents_subs_create">

                        Criar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_subs_update" name="contents_subs_update" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contents_subs['update']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contents_subs_update">

                        Editar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contents_subs_delete" name="contents_subs_delete" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contents_subs['delete']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contents_subs_delete">

                        Excluir

                    </label>

                </div>

            </div>

            <div class="col-md-3 mt-3">

                <h6 class="card-subtitle">

                    <i class="fas fa-inbox mr-1"></i>Mensagens

                </h6>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contacts_read" name="contacts_read" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contacts['read']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contacts_read">

                        Listagem

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contacts_create" name="contacts_create" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contacts['create']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contacts_create">

                        Criar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contacts_update" name="contacts_update" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contacts['update']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contacts_update">

                        Editar

                    </label>

                </div>

                <div class="custom-control custom-switch">

                    <input type="checkbox" class="custom-control-input" id="contacts_delete" name="contacts_delete" <?php echo utf8_encode(!empty($resultUerPermission->permissions->contacts['delete']) ? 'checked' : null)?>>
                    <label class="custom-control-label" for="contacts_delete">

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