<?php

/** Importação de classes */
use vendor\model\ContentsFiles;
use vendor\controller\contents_files\ContentsFilesValidade;

/** Instânciamento de classes */
$ContentsFiles = new ContentsFiles();
$ContentsFilesValidade = new ContentsFilesValidade();

/** Controle de mensagens */
$message = null;
$result = array();

try {

    /** Parâmetros de entrada */
    $ContentsFilesValidade->setContentId(@(int)$_POST['content_id']);
    $ContentsFilesValidade->setContentFileId(@(int)$_POST['content_file_id']);

    /** Verifico a existência de erros */
    if (!empty($ContentsFilesValidade->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $ContentsFilesValidade->getErrors(),

        ];

    } else {

        /** Busco oregistro */
        $resultContentFiles = $ContentsFiles->Get($ContentsFilesValidade->getContentFileId());

        /** Verifico se o usuário foi localizado */
        if ($ContentsFiles->Delete($ContentsFilesValidade->getContentFileId()))
        {

            /** Remoção do arquivo */
            unlink($resultContentFiles->path);

            /** Adição de elementos na array */
            $message = 'Registro removido com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=CONTENTS_FILES&ACTION=CONTENTS_FILES_DATAGRID&CONTENT_ID=' . $ContentsFilesValidade->getContentId(),

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
