<?php

/** Importação de classes */
use vendor\model\Situations;
use vendor\controller\situations\SituationsValidate;

/** Instânciamento de classes */
$Situations = new Situations();
$SituationsValidate = new SituationsValidate();

/** Controle de mensagens */
$message = null;
$result = array();
$history = array();

try {

    /** Parâmetros de entrada */
    $SituationsValidate->setSituationId(@(int)$_POST['situation_id']);
    $SituationsValidate->setName(@(string)$_POST['name']);
    $SituationsValidate->setDescription(@(string)$_POST['description']);

    /** Verifico o tipo de histórico */
    if ($SituationsValidate->getSituationId() > 0) {

        /** Busco o Histórico */
        $resultHistory = json_decode(base64_decode($Situations->Get($SituationsValidate->getSituationId())->history),true);

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
    $SituationsValidate->setHistory(base64_encode(json_encode($history, JSON_PRETTY_PRINT)));

    /** Verifico a existência de erros */
    if (!empty($SituationsValidate->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $SituationsValidate->getErrors(),

        ];

    } else {

        /** Verifico se o usuário foi localizado */
        if ($Situations->Save($SituationsValidate->getSituationId(), $SituationsValidate->getName(), $SituationsValidate->getDescription(), $SituationsValidate->getHistory())) {

            /** Adição de elementos na array */
            $message = 'Registro salvo com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_DATAGRID',

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
