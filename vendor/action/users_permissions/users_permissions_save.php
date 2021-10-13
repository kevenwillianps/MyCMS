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

    /** Permissões */
    $permissions['contents']['read'] = @(string)filter_input(INPUT_POST, 'contents_read', FILTER_SANITIZE_STRING);
    $permissions['contents']['create'] = @(string)filter_input(INPUT_POST, 'contents_create', FILTER_SANITIZE_STRING);
    $permissions['contents']['update'] = @(string)filter_input(INPUT_POST, 'contents_update', FILTER_SANITIZE_STRING);
    $permissions['contents']['delete'] = @(string)filter_input(INPUT_POST, 'contents_delete', FILTER_SANITIZE_STRING);

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
