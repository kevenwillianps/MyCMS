<?php

/** Importação de classes */
use \vendor\model\Main;
use \vendor\model\Configurations;
use \vendor\controller\file\File;
use \vendor\controller\file\FileValidate;
use \vendor\model\Contents;
use \vendor\model\ContentsFiles;
use \vendor\controller\contents_files\ContentsFilesValidade;

/** Instânciamento de classes */
$Main = new Main();
$Configurations = new Configurations();
$File = new File();
$FileValidate = new FileValidate();
$Contents = new Contents();
$ContentsFiles = new ContentsFiles();
$ContentsFilesValidate = new ContentsFilesValidade();

/** Controle de mensagens */
$message = null;
$result = array();

try
{

    /** Busco a configuração */
    $resultConfiguration = $Configurations->All();

    /** Decodifico as preferencias */
    $resultConfiguration->preferences = (object)json_decode(base64_decode($resultConfiguration->preferences));

    /** Operações */
    $Main->SessionStart();

    /** Parâmetros de entrada Arquivo */
    $FileValidate->setName(@(string)$_POST['descricao']);
    $FileValidate->setBase64(@(string)$_POST['arquivo']);
    $FileValidate->setPonteiro(@(int)$_POST['ponteiro']);
    $FileValidate->setTamanho(@(int)$_POST['tamanho']);

    /** Parâmetros de entrada Contents */
    $ContentsFilesValidate->setContentFileId(@(int)$_POST['content_file_id']);
    $ContentsFilesValidate->setContentId(@(int)$_POST['content_id']);
    $ContentsFilesValidate->setHighlighterId(@(int)$_POST['highlighter_id']);
    $ContentsFilesValidate->setSituationId(@(int)$_POST['situation_id']);
    $ContentsFilesValidate->setUserId(@(int)$_SESSION['USER_ID']);
    $ContentsFilesValidate->setPositionContent(@(int)$_POST['situation_id']);
    $ContentsFilesValidate->setName($resultConfiguration->preferences->file_name . $FileValidate->getName());
    $ContentsFilesValidate->setPath($resultConfiguration->preferences->file_path_contents . $ContentsFilesValidate->getContentId());

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
        $resultContent = $Contents->get($ContentsFilesValidate->getContentId());

        /** Verifico se o registro foi localizado */
        if (@(int)$resultContent->content_id > 0)
        {

            /** Verifico se é a última parte */
            if ((int)$FileValidate->getPonteiro() === ((int)$FileValidate->getTamanho() - 1))
            {

                /** Gero o arquivo */
                $File->generate($ContentsFilesValidate->getPath(), $ContentsFilesValidate->getName(), $FileValidate->getBase64());

                /** Verifico se o caminho existe */
                if (is_file($ContentsFilesValidate->getFullPath()))
                {

                    /** Manipulo as imagens */
                    $File->handling($ContentsFilesValidate->getPath(), $ContentsFilesValidate->getName(), $resultConfiguration->preferences->images_dimensions);

                    /** Salvo o registro do arquivo */
                    if ($ContentsFiles->Save($ContentsFilesValidate->getContentFileId(), $ContentsFilesValidate->getContentId(), $ContentsFilesValidate->getHighlighterId(), $ContentsFilesValidate->getSituationId(), $ContentsFilesValidate->getUserId(), $ContentsFilesValidate->getPositionContent(), $ContentsFilesValidate->getName(), $ContentsFilesValidate->getPath()))
                    {

                        /** Adição de elementos na array */
                        $message = 'Arquivo Criado com sucesso';

                        /** Result **/
                        $result = [

                            'cod' => 200,
                            'title' => 'Sucesso',
                            'message' => $message,
                            'redirect' => 'FOLDER=VIEW&TABLE=CONTENTS_FILES&ACTION=CONTENTS_FILES_DATAGRID&CONTENT_ID=' . $ContentsFilesValidate->getContentId(),

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
                $File->generate($ContentsFilesValidate->getPath(), $ContentsFilesValidate->getName(), $FileValidate->getBase64());

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