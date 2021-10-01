<?php

/** Importação de classes */
use \vendor\model\Main;
use \vendor\model\Configurations;
use \vendor\controller\file\File;
use \vendor\controller\file\FileValidate;
use \vendor\model\Users;
use \vendor\model\UsersFiles;
use \vendor\controller\users_files\UsersFilesValidate;

/** Instânciamento de classes */
$Main = new Main();
$Configurations = new Configurations();
$File = new File();
$FileValidate = new FileValidate();
$Users = new Users();
$UsersFiles = new UsersFiles();
$UsersFilesValidate = new UsersFilesValidate();

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
    $UsersFilesValidate->setUserFileId(@(int)$_POST['user_file_id']);
    $UsersFilesValidate->setUserId(@(int)$_SESSION['USER_ID']);
    $UsersFilesValidate->setName($resultConfiguration->preferences->file_name . $FileValidate->getName());
    $UsersFilesValidate->setPathCover($resultConfiguration->preferences->file_path_users_files . $UsersFilesValidate->getUserId());

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
        $resultUsers = $Users->get($UsersFilesValidate->getUserId());

        /** Verifico se o registro foi localizado */
        if (@(int)$resultUsers->user_id > 0)
        {

            /** Verifico se é a última parte */
            if ((int)$FileValidate->getPonteiro() === ((int)$FileValidate->getTamanho() - 1))
            {

                /** Gero o arquivo */
                $File->generate($UsersFilesValidate->getPathCover(), $UsersFilesValidate->getName(), $FileValidate->getBase64());

                /** Verifico se o caminho existe */
                if (is_file($UsersFilesValidate->getFullPathCover()))
                {

                    /** Manipulo as imagens */
                    $File->handling($UsersFilesValidate->getPathCover(), $UsersFilesValidate->getName(), $resultConfiguration->preferences->images_dimensions);

                    /** Salvo o registro do arquivo */
                    if ($UsersFiles->SaveProfile($UsersFilesValidate->getUserFileId(), $UsersFilesValidate->getUserId(), $UsersFilesValidate->getName(), $UsersFilesValidate->getPathCover()))
                    {

                        /** Adição de elementos na array */
                        $message = 'Arquivo Criado com sucesso';

                        /** Result **/
                        $result = [

                            'cod' => 200,
                            'title' => 'Sucesso',
                            'message' => $message,
                            'redirect' => 'FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE',

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