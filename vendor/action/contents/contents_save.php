<?php

/** Importação de classes */
use vendor\model\Main;
use vendor\model\Contents;
use vendor\controller\contents\ContentsValidade;

/** Instânciamento de classes */
$Main = new Main();
$Contents = new Contents();
$ContentsValidade = new ContentsValidade();

/** Controle de mensagens */
$message = null;
$result = array();
$history = array();

try {

    /** Operações iniciais */
    $Main->SessionStart();

    /** Parâmetros de entrada */
    $ContentsValidade->setContentId(@(int)$_POST['content_id']);
    $ContentsValidade->setContentCategoryId(@(int)$_POST['content_category_id']);
    $ContentsValidade->setHighlighters(@(int)$_POST['highlighter_id']);
    $ContentsValidade->setSituationId(@(int)$_POST['situation_id']);
    $ContentsValidade->setUserId(@(int)$_SESSION['USER_ID']);
    $ContentsValidade->setPositionContent(@(int)$_POST['position_content']);
    $ContentsValidade->setPositionMenu(@(int)$_POST['position_menu']);
    $ContentsValidade->setUrl(@(string)$_POST['url']);
    $ContentsValidade->setTitle(@(string)$_POST['title']);
    $ContentsValidade->setTitleMenu(@(string)$_POST['title_menu']);
    $ContentsValidade->setDescription(@(string)$_POST['description']);
    $ContentsValidade->setContentResume(@(string)$_POST['content_resume']);
    $ContentsValidade->setContentComplete(@(string)$_POST['content_complete']);
    $ContentsValidade->setVisited(@(int)$_POST['visited']);
    $ContentsValidade->setDateStart(@(string)$_POST['date_start']);
    $ContentsValidade->setDateClosing(@(string)$_POST['date_closing']);

    /** Verifico o tipo de histórico */
    if ($ContentsValidade->getContentId() > 0) {

        /** Busco o Histórico */
        $resultHistory = json_decode(base64_decode($Contents->Get($ContentsValidade->getContentId())->history),true);

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
    $ContentsValidade->setHistory(base64_encode(json_encode($history, JSON_PRETTY_PRINT)));

    /** Verifico a existência de erros */
    if (!empty($ContentsValidade->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $ContentsValidade->getErrors(),

        ];

    } else {

        /** Verifico se o usuário foi localizado */
        if ($Contents->Save($ContentsValidade->getContentId(), $ContentsValidade->getContentCategoryId(), $ContentsValidade->getHighlighterId(), $ContentsValidade->getSituationId(), $ContentsValidade->getUserId(), $ContentsValidade->getPositionContent(), $ContentsValidade->getPositionMenu(), $ContentsValidade->getUrl(), $ContentsValidade->getTitle(), $ContentsValidade->getTitleMenu(), $ContentsValidade->getDescription(), $ContentsValidade->getContentResume(), $ContentsValidade->getContentComplete(), $ContentsValidade->getVisited(), $ContentsValidade->getDateStart(), $ContentsValidade->getDateClosing(), $ContentsValidade->getHistory()))
        {

            /** Adição de elementos na array */
            $message = 'Registro salvo com sucesso';

            /** Result **/
            $result = [

                'cod' => 200,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=CONTENTS&ACTION=CONTENTS_DATAGRID',

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
