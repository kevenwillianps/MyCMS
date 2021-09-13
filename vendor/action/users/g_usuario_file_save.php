<?php

/** Importação de classes */
use \vendor\controller\File\File;
use \vendor\controller\File\FileValidate;
use \vendor\model\GUsuario;
use \vendor\controller\GUsuario\GUsuarioValidate;

/** Instânciamento de classes */
$fileValidate = new FileValidate();
$GUsuario = new GUsuario();
$GUsuarioValidate = new GUsuarioValidate();

try
{

    /** Parâmetros de entrada */
    $GUsuarioValidate->setUsuarioId(@(int)$_POST['usuario_id']);

    $fileValidate->setName(@(string)$_POST['descricao']);
    $fileValidate->setBase64(@(string)$_POST['arquivo']);
    $fileValidate->setPonteiro(@(int)$_POST['ponteiro']);
    $fileValidate->setTamanho(@(int)$_POST['tamanho']);

    /** Controle de mensagens */
    $message = Array();

    /** Verifico a existência de erros */
    if (count($fileValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $fileValidate->getErrors(),

        ];

    }
    else
    {

        /** Busco o registro */
        $resultGUsuario = $GUsuario->Get($GUsuarioValidate->getUsuarioId());

        /** Verifico se o registro foi localizado */
        if (@(int)$resultGUsuario->USUARIO_ID > 0)
        {

            /** Instânciamento de classes */
            $file = new File('temp/' . @(int)$resultGUsuario->USUARIO_ID);

            /** Verifico se é a última parte */
            if ((int)$fileValidate->getPonteiro() === ((int)$fileValidate->getTamanho() - 1))
            {

                /** Gero o arquivo */
                $file->generate($fileValidate->getName(), $fileValidate->getBase64());

                /** Verifico se o caminho existe */
                if (is_file($file->path($fileValidate->getName())))
                {

                    /** Tratamento da imagem */
                    $file->handling($file->path($fileValidate->getName()), 2);

                    /** Salvo o registro do arquivo */
                    if ($GUsuario->SavePhoto($GUsuarioValidate->getUsuarioId(), base64_encode(file_get_contents($file->pathJust()))))
                    {

                        /** Adição de elementos na array */
                        array_push($message, 'Arquivo vinculado com sucesso');

                        /** Result **/
                        $result = [

                            'cod' => 0,
                            'title' => 'Sucesso',
                            'message' => $message,
                            'redirect' => 'FOLDER=VIEW&PRODUCT=GR&TABLE=GUSUARIO&ACTION=G_USUARIO_DATAGRID'

                        ];

                        /** Envio **/
                        echo json_encode($result);

                        /** Paro o procedimento **/
                        exit;

                    }
                    else
                    {

                        /** Adição de elementos na array */
                        array_push($message, 'Não foi possivel vincular o arquivo');

                        /** Result **/
                        $result = [

                            'cod' => 1,
                            'title' => 'Atenção',
                            'message' => $message,

                        ];

                    }

                    exit;

                }
                else
                {

                    /** Adição de elementos na array */
                    array_push($message, 'Não foi possivel localizar o arquivo');

                    /** Result **/
                    $result = [

                        'cod' => 1,
                        'title' => 'Atenção',
                        'message' => $message,

                    ];

                }

            }
            else
            {

                /** Gero o arquivo */
                $file->generate($fileValidate->getName(), $fileValidate->getBase64());

                /** Adição de elementos na array */
                array_push($message, 'Parte inserida com sucesso');

                /** Result **/
                $result = [

                    'cod' => 3,
                    'title' => 'Atenção',
                    'message' => $message,

                ];

            }

        }
        else
        {

            /** Adição de elementos na array */
            array_push($message, 'Não foi possivel localizar o usuário');

            /** Result **/
            $result = [

                'cod' => 1,
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
    $message = array();

    /** Adição de elementos na array */
    array_push($message, '<span class="badge badge-primary">Detalhes.:</span> ' . 'código = ' . $exception->getCode() . ' - linha = ' . $exception->getLine() . ' - arquivo = ' . $exception->getFile());
    array_push($message, '<span class="badge badge-primary">Mensagem.:</span> ' . $exception->getMessage());

    /** Preparo o formulario para retorno **/
    $result = [

        'cod' => 1,
        'message' => $message,
        'title' => 'Erro Interno',
        'type' => 'exception',

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
