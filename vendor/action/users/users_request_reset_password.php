<?php

/** Importação de classes */
use \vendor\model\Users;
use \vendor\model\Configurations;
use \vendor\controller\users\UsersValidate;
use \vendor\controller\email\Email;

/** Instânciamento de classes */
$Users = new Users();
$Configurations = new Configurations();
$UsersValidate = new UsersValidate();
$Email = new Email();

/** Controle de mensagens */
$message = null;
$result = Array();

try
{

    /** Operações */
    $resultConfigurations = (object)json_decode(base64_decode($Configurations->All()->preferences));

    /** Parâmetros de entrada */
    $UsersValidate->setEmail(@(string)filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));

    /** Verifico a existência de erros */
    if (!empty($UsersValidate->getErrors()))
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $UsersValidate->getErrors(),

        ];

    }
    else
    {

        /** Realizo o acesso */
        $resultUser = $Users->GetByEmail($UsersValidate->getEmail());

        /** Verifico se o usuário foi localizado */
        if (@(int)$resultUser->user_id > 0)
        {

            /** Inicio a coleta de dados */
            ob_start();

            /** Inclusão do arquivo desejado */
            @include_once 'vendor/view/email/email_request_new_password.php';

            /** Prego a estrutura do arquivo */
            $html = ob_get_contents();

            /** Removo o arquivo incluido */
            ob_clean();

            /** Envio de emil */
            $Email->send($html, $resultUser, utf8_decode('Redefinição de senha'), $resultConfigurations);

            /** Mensagem de retorno */
            $message = 'Foi enviado um link para redefinição de senha para o seu email';

            /** Result **/
            $result = [

                'cod' => 0,
                'title' => 'Atenção',
                'message' => $message,

            ];

        }
        else
        {

            /** Adição de elementos na array */
            $message = 'Não foi possivel localizar o usuário';

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

}
catch (Exception $exception)
{

    /** Controle de mensagens */
    $message  = '<span class="badge badge-primary">Detalhes.:</span> ' . 'código = ' . $exception->getCode() . ' - linha = ' . $exception->getLine() . ' - arquivo = ' . $exception->getFile() . '</br>';
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
