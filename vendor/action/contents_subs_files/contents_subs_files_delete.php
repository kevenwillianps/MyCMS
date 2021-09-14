<?php

/** Importação de classes */
use vendor\model\ContentsSubsFiles;
use vendor\controller\contents_subs_files\ContentsSubsFilesValidaTe;

/** Instânciamento de classes */
$ContentsSubsFiles = new ContentsSubsFiles();
$ContentsSubsFilesValidaTe = new ContentsSubsFilesValidaTe();

/** Controle de mensagens */
$message = null;
$result = array();

try {

    /** Parâmetros de entrada */
    $ContentsSubsFilesValidaTe->setContentSubId(@(int)$_POST['content_sub_id']);
    $ContentsSubsFilesValidaTe->setContentSubFileId(@(int)$_POST['content_sub_file_id']);

    /** Verifico a existência de erros */
    if (!empty($ContentsSubsFilesValidaTe->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $ContentsSubsFilesValidaTe->getErrors(),

        ];

    } else {

        /** Busco oregistro */
        $resultContentSubFile = $ContentsSubsFiles->Get($ContentsSubsFilesValidaTe->getContentSubFileId());

        /** Verifico se o usuário foi localizado */
        if ($ContentsSubsFiles->Delete($ContentsSubsFilesValidaTe->getContentSubFileId()))
        {

            /** Remoção do arquivo */
            unlink($resultContentSubFile->path);

            /** Adição de elementos na array */
            $message = 'Registro removido com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=CONTENTS_SUBS_FILES&ACTION=CONTENTS_SUBS_FILES_DATAGRID&CONTENT_SUB_ID=' . $ContentsSubsFilesValidaTe->getContentSubId(),

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
