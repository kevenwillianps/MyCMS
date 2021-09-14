<?php

/** Importação de classes */
use \vendor\model\Main;
use \vendor\controller\File\File;
use \vendor\controller\File\FileValidate;
use \vendor\model\ContentsSubs;
use \vendor\model\ContentsSubsFiles;
use \vendor\controller\contents_subs_files\ContentsSubsFilesValidaTe;

/** Instânciamento de classes */
$Main = new Main();
$FileValidate = new FileValidate();
$ContentsSubs = new ContentsSubs();
$ContentsSubsFiles = new ContentsSubsFiles();
$ContentsSubsFilesValidaTe = new ContentsSubsFilesValidaTe();

/** Controle de mensagens */
$message = null;
$result = array();

try
{

    /** Operações */
    $Main->SessionStart();

    /** Parâmetros de entrada */
    $ContentsSubsFilesValidaTe->setContentSubFileId(@(int)$_POST['content_sub_file_id']);
    $ContentsSubsFilesValidaTe->setContentSubId(@(int)$_POST['content_sub_id']);
    $ContentsSubsFilesValidaTe->setHighlighterId(@(int)$_POST['highlighter_id']);
    $ContentsSubsFilesValidaTe->setSituationId(@(int)$_POST['situation_id']);
    $ContentsSubsFilesValidaTe->setUserId(@(int)$_SESSION['USER_ID']);
    $ContentsSubsFilesValidaTe->setPositionContent(@(int)$_POST['situation_id']);

    $FileValidate->setName(@(string)$_POST['descricao']);
    $FileValidate->setBase64(@(string)$_POST['arquivo']);
    $FileValidate->setPonteiro(@(int)$_POST['ponteiro']);
    $FileValidate->setTamanho(@(int)$_POST['tamanho']);

    /** Verifico a existência de erros */
    if (!empty($FileValidate->getErrors()))
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $ContentsSubsValidate->getErrors(),

        ];

    }
    else
    {

        /** Busco o registro */
        $resultContentSub = $ContentsSubs->get($ContentsSubsFilesValidaTe->getContentSubId());

        /** Verifico se o registro foi localizado */
        if (@(int)$resultContentSub->content_sub_id > 0)
        {

            /** Instânciamento de classes */
            $File = new File('Product/Version/Release/' . $ContentsSubsFilesValidaTe->getContentSubId());

            /** Verifico se é a última parte */
            if ((int)$FileValidate->getPonteiro() === ((int)$FileValidate->getTamanho() - 1))
            {

                $ContentsSubsFilesValidaTe->setName($FileValidate->getName());
                $ContentsSubsFilesValidaTe->setPath($File->path($FileValidate->getName()));

                /** Gero o arquivo */
                $File->generate($FileValidate->getName(), $FileValidate->getBase64());

                /** Verifico se o caminho existe */
                if (is_file($File->path($FileValidate->getName())))
                {

                    /** Salvo o registro do arquivo */
                    if ($ContentsSubsFiles->Save($ContentsSubsFilesValidaTe->getContentSubFileId(), $ContentsSubsFilesValidaTe->getContentSubId(), $ContentsSubsFilesValidaTe->getHighlighterId(), $ContentsSubsFilesValidaTe->getSituationId(), $ContentsSubsFilesValidaTe->getUserId(), $ContentsSubsFilesValidaTe->getPositionContent(), $ContentsSubsFilesValidaTe->getName(), $ContentsSubsFilesValidaTe->getPath()))
                    {

                        /** Adição de elementos na array */
                        $message = 'Arquivo Criado com sucesso';

                        /** Result **/
                        $result = [

                            'cod' => 200,
                            'title' => 'Sucesso',
                            'message' => $message,
                            'redirect' => 'FOLDER=VIEW&TABLE=CONTENTS_SUBS_FILES&ACTION=CONTENTS_SUBS_FILES_DATAGRID&CONTENT_SUB_ID=' . $ContentsSubsFilesValidaTe->getContentSubId(),

                        ];

                    }
                    else
                    {

                        /** Adição de elementos na array */
                        $message = 'Não foi possivel vincular o arquivo';

                        /** Result **/
                        $result = [

                            'cod' => 0,
                            'title' => 'Erro',
                            'message' => $message,

                        ];

                    }

                }
                else
                {

                    /** Adição de elementos na array */
                    $message = 'Não foi possivel localizar o arquivo';

                    /** Result **/
                    $result = [

                        'cod' => 0,
                        'title' => 'Erro',
                        'message' => $message,

                    ];

                }

            }
            else
            {

                /** Gero o arquivo */
                $File->generate($FileValidate->getName(), $FileValidate->getBase64());

                /** Adição de elementos na array */
                $message = 'Parte inserida com sucesso';

                /** Result **/
                $result = [

                    'cod' => 3,
                    'title' => 'Erro',
                    'message' => $message,

                ];

            }

        }
        else
        {

            /** Adição de elementos na array */
            $message = 'Não foi possivel localizar o arquivo';

            /** Result **/
            $result = [

                'cod' => 0,
                'title' => 'Erro',
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