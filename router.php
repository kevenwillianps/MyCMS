<?php

require_once('./vendor/autoload.php');
require_once('./vendor/model/wideImage/WideImage.php');
require_once('./vendor/model/phpmailer/autoload.php');

/** Parâmetros de entrada **/
$table = strtolower(isset($_REQUEST['TABLE']) ? htmlspecialchars($_REQUEST['TABLE']) : null);
$action = strtolower(isset($_REQUEST['ACTION']) ? htmlspecialchars($_REQUEST['ACTION']) : null);
$folder = strtolower(isset($_REQUEST['FOLDER']) ? htmlspecialchars($_REQUEST['FOLDER']) : null);

try
{

    /** Verifico se a tabela foi preenchida */
    if (!empty($table))
    {

        /** Verfico se a ação foi preenchida */
        if (!empty($action))
        {

            /** Verifico se o arquivo de ação existe */
            if (is_file('vendor/' . $folder . '/'. $table . '/' . $action . '.php'))
            {

                /** Inicio a coleta de dados */
                ob_start();

                /** Inclusão do arquivo desejado */
                @include_once 'vendor/' . $folder . '/'. $table . '/' . $action . '.php';

                /** Prego a estrutura do arquivo */
                $div = ob_get_contents();

                /** Removo o arquivo incluido */
                ob_clean();

                /** Result **/
                $result = array(

                    'cod' => 0,
                    'data' => $div,

                );

                /** Envio **/
                echo json_encode($result);

                /** Paro o procedimento **/
                exit;

            }
            else
            {

                /** Mensagem de erro */
                throw new Exception('Erro :: Não há arquivo para ação informada.');

            }

        }
        else
        {

            /** Mensagem de erro */
            throw new Exception('Erro :: ação não informada.');

        }

    }
    else
    {

        /** Mensagem de erro */
        throw new Exception('Erro :: tabela não informada.');

    }

}
catch(Exception $exception)
{

    /** Adição de elementos na array */
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