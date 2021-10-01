<?php

/** Importação de classes */
use vendor\model\Configurations;
use vendor\controller\configurations\ConfigurationsValidate;

/** Instânciamento de classes */
$Configurations = new Configurations();
$ConfigurationsValidate = new ConfigurationsValidate();

/** Controle de mensagens */
$message = null;
$result = array();
$history = array();
$preferences = array();

try {

    /** Parâmetros de entrada */
    $ConfigurationsValidate->setConfigurationId(@(int)$_POST['configuration_id']);
    $ConfigurationsValidate->setTitle(@(string)$_POST['title']);
    $ConfigurationsValidate->setCopyright(@(string)$_POST['copyright']);
    $ConfigurationsValidate->setAuthor(@(string)$_POST['author']);
    $ConfigurationsValidate->setDescription(@(string)$_POST['description']);
    $ConfigurationsValidate->setKeywords(@(string)$_POST['keywords']);

    /** Preferencias */
    $preferences['file_path_contents'] = @(string)$_POST['file_path_contents'];
    $preferences['file_path_contents_subs'] = @(string)$_POST['file_path_contents_subs'];
    $preferences['file_path_users_files'] = @(string)$_POST['file_path_users_files'];
    $preferences['file_name'] = @(string)$_POST['file_name'];
    $preferences['twitter_user'] = @(string)$_POST['twitter_user'];
    $preferences['facebook_id'] = @(string)$_POST['facebook_id'];
    $preferences['url'] = @(string)$_POST['url'];
    $preferences['images_dimensions'] = array();

    $preferences['email_host'] = @(string)$_POST['email_host'];
    $preferences['email_username'] = @(string)$_POST['email_username'];
    $preferences['email_port'] = @(string)$_POST['email_port'];
    $preferences['email_password'] = @(string)$_POST['email_password'];

    /** Salvo o histórico do registro */
    $ConfigurationsValidate->setPreferences(base64_encode(json_encode($preferences, JSON_PRETTY_PRINT)));

    /** Verifico o tipo de histórico */
    if ($ConfigurationsValidate->getConfigurationId() > 0) {

        /** Busco o Histórico */
        $resultHistory = json_decode(base64_decode($Configurations->Get($ConfigurationsValidate->getConfigurationId())->history),true);

        /** Captura dos dados de login */
        $history[0]['title'] = 'Atualização';
        $history[0]['description'] = 'Atualização no registro';
        $history[0]['class'] = 'badge-warning';

        /** Junto as array */
        $history = array_merge($history, $resultHistory);

    } else {

        /** Captura dos dados de login */
        $history[0]['title'] = 'Cadastro';
        $history[0]['description'] = 'Novo registro cadastrado';
        $history[0]['class'] = 'badge-success';

    }

    $history[0]['date'] = date('d-m-Y');
    $history[0]['time'] = date('H:i:s');

    /** Salvo o histórico do registro */
    $ConfigurationsValidate->setHistory(base64_encode(json_encode($history, JSON_PRETTY_PRINT)));

    /** Verifico a existência de erros */
    if (!empty($ConfigurationsValidate->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $ConfigurationsValidate->getErrors(),

        ];

    } else {

        /** Verifico se o usuário foi localizado */
        if ($Configurations->Save($ConfigurationsValidate->getConfigurationId(), $ConfigurationsValidate->getTitle(), $ConfigurationsValidate->getCopyright(), $ConfigurationsValidate->getAuthor(), $ConfigurationsValidate->getDescription(), $ConfigurationsValidate->getKeywords(), $ConfigurationsValidate->getPreferences(), $ConfigurationsValidate->getHistory()))
        {

            /** Adição de elementos na array */
            $message = 'Registro salvo com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_DATAGRID',

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
