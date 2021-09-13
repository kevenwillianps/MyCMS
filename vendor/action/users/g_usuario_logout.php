<?php

/** Importação das classes */
use \vendor\Model\Main;

/** Instânciamento das classes */
$main = new Main();

try
{

    /** Controle de mensagens */
    $message = array();

    /** Inicio a sessão */
    $main->SessionStart();

    /** Encerro a sessão */
    $main->SessionDestroy();

    /** Adição de elementos na array */
    array_push($message, 'Sessão encerrada');

    /** Result **/
    $result = [

        'cod' => 99,
        'title' => 'Atenção',
        'message' => $message,

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
catch (Exception $exception)
{

    /** Controle de mensagens */
    $message = array();

    /** Adição de elementos na array */
    array_push($message, array('Atenção', array('erro', '<span class="badge badge-primary">Detalhes.:</span> ' . 'código = ' . $exception->getCode() . ' - linha = ' . $exception->getLine() . ' - arquivo = ' . $exception->getFile())));
    array_push($message, array('Atenção', array('erro', '<span class="badge badge-primary">Mensagem.:</span> ' . $exception->getMessage())));

    /** Preparo o formulario para retorno **/
    $result = [

        'cod' => 500,
        'message' => $message,
        'title' => 'Erro Interno',
        'type' => 'exception',

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}