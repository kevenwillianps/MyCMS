<?php

/** Importação de classes */
use vendor\model\Configurations;
use vendor\controller\configurations\ConfigurationsValidate;
use vendor\controller\configurations\ConfigurationsImagePreferenceValidate;

/** Instânciamento de classes */
$Configurations = new Configurations();
$ConfigurationsValidate = new ConfigurationsValidate();
$ConfigurationsImagePreferenceValidate = new ConfigurationsImagePreferenceValidate();

/** Controle de mensagens */
$message = null;
$result = array();
$history = array();
$preferences = array();

try {

    /** Parâmetros de entrada */
    $ConfigurationsValidate->setConfigurationId(@(int)$_POST['configuration_id']);
    $ConfigurationsImagePreferenceValidate->setIndice(@(int)$_POST['indice']);

    /** Verifico a existência de erros */
    if (!empty($ConfigurationsImagePreferenceValidate->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $ConfigurationsImagePreferenceValidate->getErrors(),

        ];

    } else {

        /** Busco as configurações já existentes */
        $resultConfiguration = $Configurations->All();

        /** Decodifico as preferencias */
        $resultConfiguration->preferences = (object)json_decode(base64_decode($resultConfiguration->preferences));

        /** Removo o Elemento */
        unset($resultConfiguration->preferences->images_dimensions[$ConfigurationsImagePreferenceValidate->getIndice()]);

        /** Defino as preferencias */
        $ConfigurationsValidate->setPreferences(base64_encode(json_encode($resultConfiguration->preferences, JSON_PRETTY_PRINT)));

        /** Verifico se o usuário foi localizado */
        if ($Configurations->SavePreference($ConfigurationsValidate->getConfigurationId(), $ConfigurationsValidate->getPreferences()))
        {

            /** Adição de elementos na array */
            $message = 'Registro salvo com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_IMAGE_PREFERENCE_DATAGRID',

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
