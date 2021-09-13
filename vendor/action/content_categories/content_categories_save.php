<?php

/** Importação de classes */
use vendor\model\Main;
use vendor\model\ContentCategories;
use vendor\controller\content_categories\ContentCategoriesValidate;

/** Instânciamento de classes */
$Main = new Main();
$ContentCategories = new ContentCategories();
$ContentCategoriesValidate = new ContentCategoriesValidate();

/** Controle de mensagens */
$message = null;
$result = array();
$history = array();

try {

    /** Operações iniciais */
    $Main->SessionStart();

    /** Parâmetros de entrada */
    $ContentCategoriesValidate->setContentCategoryId(@(int)$_POST['content_category_id']);
    $ContentCategoriesValidate->setSituationId(@(int)$_POST['situation_id']);
    $ContentCategoriesValidate->setUserId(@(int)$_SESSION['USER_ID']);
    $ContentCategoriesValidate->setName(@(string)$_POST['name']);
    $ContentCategoriesValidate->setDescription(@(string)$_POST['description']);

    /** Verifico o tipo de histórico */
    if ($ContentCategoriesValidate->getSituationId() > 0) {

        /** Busco o Histórico */
        $resultHistory = json_decode(base64_decode($ContentCategories->Get($ContentCategoriesValidate->getContentCategoryId())->history),true);

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
    $ContentCategoriesValidate->setHistory(base64_encode(json_encode($history, JSON_PRETTY_PRINT)));

    /** Verifico a existência de erros */
    if (!empty($ContentCategoriesValidate->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $ContentCategoriesValidate->getErrors(),

        ];

    } else {

        /** Verifico se o usuário foi localizado */
        if ($ContentCategories->Save($ContentCategoriesValidate->getContentCategoryId(), $ContentCategoriesValidate->getSituationId(), $ContentCategoriesValidate->getUserId(), $ContentCategoriesValidate->getName(), $ContentCategoriesValidate->getDescription(), $ContentCategoriesValidate->getHistory()))
        {

            /** Adição de elementos na array */
            $message = 'Registro salvo com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=CONTENT_CATEGORIES&ACTION=CONTENT_CATEGORIES_DATAGRID',

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
