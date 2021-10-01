<?php

/** Importação de classes */
use \vendor\model\Main;
use \vendor\model\Users;
use \vendor\model\Configurations;
use \vendor\controller\users\UsersValidate;
use \vendor\controller\email\Email;

/** Instânciamento de classes */
$Main = new Main();
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
    $UsersValidate->setEmail(@(string)$_POST['email']);
    $UsersValidate->setPassword(@(string)$_POST['password']);

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
        $resultUser = (object)$Users->Access($UsersValidate->getEmail(), md5($UsersValidate->getPassword()));

        /** Verifico se o usuário foi localizado */
        if (@(int)$resultUser->user_id > 0)
        {

            /** Operações */
            $Main->SessionStart();

            /** Montagem da sessão */
            $_SESSION['USER_ID'] = $resultUser->user_id;
            $_SESSION['USER_NAME_FIRST'] = $resultUser->name_first;
            $_SESSION['USER_NAME_LAST'] = $resultUser->name_last;

            /** Busco o Histórico */
            $resultHistory = json_decode($resultUser->history,true);

            /** Captura dos dados de login */
            $history[0]['title'] = 'Login';
            $history[0]['description'] = 'Acesso Realizado no dia';
            $history[0]['date'] = date('d-m-Y');
            $history[0]['time'] = date('H:i:s');
            $history[0]['class'] = 'badge-primary';

            /** Verifico se já existe histórico */
            if (!empty($resultUser->history))
            {

                /** Junto as array */
                $history = array_merge($history, $resultHistory);

            }

            /** Codifico para JSON */
            $history = json_encode($history, JSON_PRETTY_PRINT);

            /** Gero o arquivo de LOG */
            if ($Users->SaveHistory((int)$resultUser->user_id, (string)$history))
            {

                /** Inicio a coleta de dados */
                ob_start();

                /** Inclusão do arquivo desejado */
                @include_once 'vendor/view/email/email_info_login.php';

                /** Prego a estrutura do arquivo */
                $html = ob_get_contents();

                /** Removo o arquivo incluido */
                ob_clean();

                /** Envio de emil */
                $Email->send($html, $resultUser, 'Login Realizado', $resultConfigurations);

                /** Result **/
                $result = [

                    'cod' => 202,
                    'title' => 'Sucesso',
                    'message' => $message,

                ];

            }
            else
            {

                /** Adição de elementos na array */
                $message = 'Não foi possivel criar o arquivo de log';

                /** Result **/
                $result = [

                    'cod' => 0,
                    'title' => 'Atenção',
                    'message' => $message,

                ];

            }

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