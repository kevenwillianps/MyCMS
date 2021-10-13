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

try {

    /** Parâmetros de entrada */
    $UsersPermissionsValidate->setUserPermissionId(@(int)$_POST['user_permission_id']);

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
        if ($UsersPermissions->Delete($UsersPermissionsValidate->getUserPermissionId())) {

            /** Adição de elementos na array */
            $message = 'Registro removido com sucesso';

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
