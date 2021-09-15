<?php

/** Importação de classes */
use vendor\model\Main;
use vendor\model\ContentsSubs;
use vendor\controller\contents_subs\ContentsSubsValidate;

/** Instânciamento de classes */
$Main = new Main();
$ContentsSubs = new ContentsSubs();
$ContentsSubsValidate = new ContentsSubsValidate();

/** Controle de mensagens */
$message = null;
$result = array();
$history = array();

try {

    /** Operações iniciais */
    $Main->SessionStart();

    /** Parâmetros de entrada */
    $ContentsSubsValidate->setContentSubId(@(int)$_POST['content_sub_id']);
    $ContentsSubsValidate->setContentId(@(int)$_POST['content_id']);
    $ContentsSubsValidate->setHighlighterId(@(int)$_POST['highlighter_id']);
    $ContentsSubsValidate->setSituationId(@(int)$_POST['situation_id']);
    $ContentsSubsValidate->setUserId(@(int)$_SESSION['USER_ID']);
    $ContentsSubsValidate->setPositionContent(@(int)$_POST['position_content']);
    $ContentsSubsValidate->setPositionMenu(@(int)$_POST['position_menu']);
    $ContentsSubsValidate->setUrl(@(string)$_POST['url']);
    $ContentsSubsValidate->setTitle(@(string)$_POST['title']);
    $ContentsSubsValidate->setTitleMenu(@(string)$_POST['title_menu']);
    $ContentsSubsValidate->setDescription(@(string)$_POST['description']);
    $ContentsSubsValidate->setContentResume(@(string)$_POST['content_resume']);
    $ContentsSubsValidate->setContentComplete(@(string)$_POST['content_complete']);
    $ContentsSubsValidate->setKeywords(@(string)$_POST['keywords']);
    $ContentsSubsValidate->setDateStart(@(string)$_POST['date_start']);
    $ContentsSubsValidate->setDateClosing(@(string)$_POST['date_closing']);

    /** Verifico o tipo de histórico */
    if ($ContentsSubsValidate->getContentSubId() > 0) {

        /** Busco o Histórico */
        $resultHistory = json_decode(base64_decode($ContentsSubs->Get($ContentsSubsValidate->getContentSubId())->history),true);

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
    $ContentsSubsValidate->setHistory(base64_encode(json_encode($history, JSON_PRETTY_PRINT)));

    /** Verifico a existência de erros */
    if (!empty($ContentsSubsValidate->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $ContentsSubsValidate->getErrors(),

        ];

    } else {

        /** Verifico se o usuário foi localizado */
        if ($ContentsSubs->Save($ContentsSubsValidate->getContentSubId(), $ContentsSubsValidate->getContentId(), $ContentsSubsValidate->getHighlighterId(), $ContentsSubsValidate->getSituationId(), $ContentsSubsValidate->getUserId(), $ContentsSubsValidate->getPositionContent(), $ContentsSubsValidate->getPositionMenu(), $ContentsSubsValidate->getUrl(), $ContentsSubsValidate->getTitle(), $ContentsSubsValidate->getTitleMenu(), $ContentsSubsValidate->getDescription(), $ContentsSubsValidate->getContentResume(), $ContentsSubsValidate->getContentComplete(), $ContentsSubsValidate->getKeywords(), $ContentsSubsValidate->getDateStart(), $ContentsSubsValidate->getDateClosing(), $ContentsSubsValidate->getHistory()))
        {

            /** Adição de elementos na array */
            $message = 'Registro salvo com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=CONTENTS_SUBS&ACTION=CONTENTS_SUBS_DATAGRID&CONTENT_ID=' . $ContentsSubsValidate->getContentId(),

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
