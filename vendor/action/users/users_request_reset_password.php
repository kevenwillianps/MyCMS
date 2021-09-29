<?php

/** Importação de classes */
use \vendor\model\Users;
use \vendor\controller\users\UsersValidate;
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;

/** Instânciamento de classes */
$Users = new Users();
$UsersValidate = new UsersValidate();
$mail = new PHPMailer(true);

/** Controle de mensagens */
$message = null;
$result = Array();

try
{

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

            /** Configurações do servidor */
            $mail->isSMTP();
            $mail->Host = 'mail.souza.inf.br';
            $mail->SMTPAuth = true;
            $mail->Username = 'contato@souza.inf.br';
            $mail->Password = 'Star147oi.';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            //Recipients
            $mail->setFrom('contato@souza.inf.br', 'Envio pelo formulario de contato');
            $mail->addAddress('kevenwillian@outlook.com', 'Graciele Souza');
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            /** Conteúdo */
            $mail->isHTML(true);
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->Send()) {

                /** Adição de elementos na array */
                $message = 'Não foi possivel enviar o email:' . $mail->ErrorInfo;;

            } else {

                /** Adição de elementos na array */
                $message = 'Foi enviado um link para redefinição de senha para o seu email.';

            }

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
