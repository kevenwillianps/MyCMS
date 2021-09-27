<?php

/** Importação de classes */
use vendor\model\Users;
use vendor\controller\users\UsersValidate;

/** Instânciamento de classes */
$Users = new Users();
$UsersValidate = new UsersValidate();

/** Controle de mensagens */
$message = null;
$result = array();
$history = array();

try {

    /** Parâmetros de entrada */
    $UsersValidate->setUserId(@(int)filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING));
    $UsersValidate->setNameFirst(@(string)filter_input(INPUT_POST, 'name_first', FILTER_SANITIZE_STRING));
    $UsersValidate->setNameLast(@(string)filter_input(INPUT_POST, 'name_last', FILTER_SANITIZE_STRING));
    $UsersValidate->setDateBirth(@(string)filter_input(INPUT_POST, 'date_birth', FILTER_SANITIZE_STRING));
    $UsersValidate->setEmail(@(string)filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
    $UsersValidate->setPassword(@(string)filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

    /** Busco o registro */
    $resultUsers = $Users->Get($UsersValidate->getUserId());

    /** Verifico o tipo de histórico */
    if ($Users->Get($UsersValidate->getUserId()) > 0) {

        /** Busco o Histórico */
        $resultHistory = json_decode(base64_decode($resultUsers->history),true);

        /** Captura dos dados de login */
        $history[0]['title'] = 'Atualização';
        $history[0]['description'] = 'Atualização no registro';
        $history[0]['class'] = 'badge-warning';

        /** Junto as array */
        $history = array_merge($history, $resultHistory);

    } else {

        /** Captura dos dados de login */
        $history[0]['title'] = 'Cadastro';
        $history[0]['description'] = 'Novo registro cadastrado';
        $history[0]['class'] = 'badge-success';

    }

    $history[0]['date'] = date('d-m-Y');
    $history[0]['time'] = date('H:i:s');

    /** Salvo o histórico do registro */
    $UsersValidate->setHistory(base64_encode(json_encode($history, JSON_PRETTY_PRINT)));

    /** Verifico se devo alterar a senha */
    if ($UsersValidate->getUserId() > 0 && empty($UsersValidate->getPassword()))
    {

        /** Busco a senha existente */
        $UsersValidate->setPassword($resultUsers->password);

    }
    else
    {

        /** Criptografo a senha */
        $UsersValidate->setPassword(md5($UsersValidate->getPassword()));

    }

    /** Verifico a existência de erros */
    if (!empty($UsersValidate->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $UsersValidate->getErrors(),

        ];

    } else {

        /** Verifico se o usuário foi localizado */
        if ($Users->Save($UsersValidate->getUserId(), $UsersValidate->getNameFirst(), $UsersValidate->getNameLast(), $UsersValidate->getDateBirth(), $UsersValidate->getEmail(), $UsersValidate->getPassword(), $UsersValidate->getHistory()))
        {

            /** Adição de elementos na array */
            $message = 'Registro salvo com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=USERS&ACTION=USERS_DATAGRID',

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
