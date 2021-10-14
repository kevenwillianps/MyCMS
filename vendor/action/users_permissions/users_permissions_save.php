<?php

/** Importação de classes */
use vendor\model\UsersPermissions;
use vendor\controller\users_permissions\UsersPermissionsValidate;

/** Instânciamento de classes */
$UsersPermissions = new UsersPermissions();
$UsersPermissionsValidate = new UsersPermissionsValidate();

/** Controle de mensagens */
$message = null;
$result = array();
$history = array();

try {

    /** Parâmetros de entrada */
    $UsersPermissionsValidate->setUserPermissionId(@(int)filter_input(INPUT_POST, 'user_permission_id', FILTER_SANITIZE_STRING));
    $UsersPermissionsValidate->setName(@(string)filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $UsersPermissionsValidate->setDescription(@(string)filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));

    /** Permissões de usuário */
    $permissions['configurations']['read'] = @(string)filter_input(INPUT_POST, 'configurations_read', FILTER_SANITIZE_STRING);
    $permissions['configurations']['create'] = @(string)filter_input(INPUT_POST, 'configurations_create', FILTER_SANITIZE_STRING);
    $permissions['configurations']['update'] = @(string)filter_input(INPUT_POST, 'configurations_update', FILTER_SANITIZE_STRING);
    $permissions['configurations']['delete'] = @(string)filter_input(INPUT_POST, 'configurations_delete', FILTER_SANITIZE_STRING);

    /** Permissões de usuário */
    $permissions['users_permissions']['read'] = @(string)filter_input(INPUT_POST, 'users_permissions_read', FILTER_SANITIZE_STRING);
    $permissions['users_permissions']['create'] = @(string)filter_input(INPUT_POST, 'users_permissions_create', FILTER_SANITIZE_STRING);
    $permissions['users_permissions']['update'] = @(string)filter_input(INPUT_POST, 'users_permissions_update', FILTER_SANITIZE_STRING);
    $permissions['users_permissions']['delete'] = @(string)filter_input(INPUT_POST, 'users_permissions_delete', FILTER_SANITIZE_STRING);

    /** Permissões de usuário */
    $permissions['users']['read'] = @(string)filter_input(INPUT_POST, 'users_read', FILTER_SANITIZE_STRING);
    $permissions['users']['create'] = @(string)filter_input(INPUT_POST, 'users_create', FILTER_SANITIZE_STRING);
    $permissions['users']['update'] = @(string)filter_input(INPUT_POST, 'users_update', FILTER_SANITIZE_STRING);
    $permissions['users']['delete'] = @(string)filter_input(INPUT_POST, 'users_delete', FILTER_SANITIZE_STRING);

    /** Permissões de usuário */
    $permissions['situations']['read'] = @(string)filter_input(INPUT_POST, 'situations_read', FILTER_SANITIZE_STRING);
    $permissions['situations']['create'] = @(string)filter_input(INPUT_POST, 'situations_create', FILTER_SANITIZE_STRING);
    $permissions['situations']['update'] = @(string)filter_input(INPUT_POST, 'situations_update', FILTER_SANITIZE_STRING);
    $permissions['situations']['delete'] = @(string)filter_input(INPUT_POST, 'situations_delete', FILTER_SANITIZE_STRING);

    /** Permissões de usuário */
    $permissions['highlighters']['read'] = @(string)filter_input(INPUT_POST, 'highlighters_read', FILTER_SANITIZE_STRING);
    $permissions['highlighters']['create'] = @(string)filter_input(INPUT_POST, 'highlighters_create', FILTER_SANITIZE_STRING);
    $permissions['highlighters']['update'] = @(string)filter_input(INPUT_POST, 'highlighters_update', FILTER_SANITIZE_STRING);
    $permissions['highlighters']['delete'] = @(string)filter_input(INPUT_POST, 'highlighters_delete', FILTER_SANITIZE_STRING);

    /** Permissões de usuário */
    $permissions['content_categories']['read'] = @(string)filter_input(INPUT_POST, 'content_categories_read', FILTER_SANITIZE_STRING);
    $permissions['content_categories']['create'] = @(string)filter_input(INPUT_POST, 'content_categories_create', FILTER_SANITIZE_STRING);
    $permissions['content_categories']['update'] = @(string)filter_input(INPUT_POST, 'content_categories_update', FILTER_SANITIZE_STRING);
    $permissions['content_categories']['delete'] = @(string)filter_input(INPUT_POST, 'content_categories_delete', FILTER_SANITIZE_STRING);

    /** Permissões de conteúdo */
    $permissions['contents']['read'] = @(string)filter_input(INPUT_POST, 'contents_read', FILTER_SANITIZE_STRING);
    $permissions['contents']['create'] = @(string)filter_input(INPUT_POST, 'contents_create', FILTER_SANITIZE_STRING);
    $permissions['contents']['update'] = @(string)filter_input(INPUT_POST, 'contents_update', FILTER_SANITIZE_STRING);
    $permissions['contents']['delete'] = @(string)filter_input(INPUT_POST, 'contents_delete', FILTER_SANITIZE_STRING);

    /** Permissões de sub-conteúdo */
    $permissions['contents_subs']['read'] = @(string)filter_input(INPUT_POST, 'contents_subs_read', FILTER_SANITIZE_STRING);
    $permissions['contents_subs']['create'] = @(string)filter_input(INPUT_POST, 'contents_subs_create', FILTER_SANITIZE_STRING);
    $permissions['contents_subs']['update'] = @(string)filter_input(INPUT_POST, 'contents_subs_update', FILTER_SANITIZE_STRING);
    $permissions['contents_subs']['delete'] = @(string)filter_input(INPUT_POST, 'contents_subs_delete', FILTER_SANITIZE_STRING);

    /** Permissões de sub-conteúdo */
    $permissions['contacts']['read'] = @(string)filter_input(INPUT_POST, 'contacts_read', FILTER_SANITIZE_STRING);
    $permissions['contacts']['create'] = @(string)filter_input(INPUT_POST, 'contacts_create', FILTER_SANITIZE_STRING);
    $permissions['contacts']['update'] = @(string)filter_input(INPUT_POST, 'contacts_update', FILTER_SANITIZE_STRING);
    $permissions['contacts']['delete'] = @(string)filter_input(INPUT_POST, 'contacts_delete', FILTER_SANITIZE_STRING);

    /** Salvo o histórico do registro */
    $UsersPermissionsValidate->setPermissions(base64_encode(json_encode($permissions, JSON_PRETTY_PRINT)));

    /** Verifico a existência de erros */
    if (!empty($UsersPermissionsValidate->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $UsersPermissionsValidate->getErrors(),

        ];

    } else {

        /** Verifico se o usuário foi localizado */
        if ($UsersPermissions->Save($UsersPermissionsValidate->getUserPermissionId(), $UsersPermissionsValidate->getName(), $UsersPermissionsValidate->getDescription(), $UsersPermissionsValidate->getPermissions())) {

            /** Adição de elementos na array */
            $message = 'Registro salvo com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=USERS_PERMISSIONS&ACTION=USERS_PERMISSIONS_DATAGRID',

            ];

        } else {

            /** Adição de elementos na array */
            $message = 'Não foi possivel salvar o registro';

            /** Result **/
            $result = [

                'cod' => 0,
                'title' => 'Atenção',
                'message' => $message,

            ];

        }

    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

} catch (Exception $exception) {

    /** Controle de mensagens */
    $message = '<span class="badge badge-primary">Detalhes.:</span> ' . 'código = ' . $exception->getCode() . ' - linha = ' . $exception->getLine() . ' - arquivo = ' . $exception->getFile() . '</br>';
    $message .= '<span class="badge badge-primary">Mensagem.:</span> ' . $exception->getMessage();

    /** Preparo o formulario para retorno **/
    $result = [

        'cod' => 500,
        'message' => $message,
        'title' => 'Erro Interno',

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
