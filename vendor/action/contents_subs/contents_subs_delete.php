<?php

/** Importação de classes */
use vendor\model\ContentsSubs;
use vendor\controller\contents_subs\ContentsSubsValidate;

/** Instânciamento de classes */
$ContentsSubs = new ContentsSubs();
$ContentsSubsValidate = new ContentsSubsValidate();

/** Controle de mensagens */
$message = null;
$result = array();

try {

    /** Parâmetros de entrada */
    $ContentsSubsValidate->setContentId(@(int)$_POST['content_id']);
    $ContentsSubsValidate->setContentSubId(@(int)$_POST['content_sub_id']);

    /** Verifico a existência de erros */
    if (!empty($ContentsSubsValidate->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $ContentsSubsValidate->getErrors(),

        ];

    } else {

        /** Verifico se o usuário foi localizado */
        if ($ContentsSubs->Delete($ContentsSubsValidate->getContentSubId())) {

            /** Adição de elementos na array */
            $message = 'Registro removido com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=CONTENTS_SUBS&ACTION=CONTENTS_SUBS_DATAGRID&CONTENT_ID=' . $ContentsSubsValidate->getContentId(),

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
