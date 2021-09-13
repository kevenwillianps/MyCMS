<?php

/** Importação de classes */
use vendor\model\GSequencia;
use vendor\model\GUsuario;
use vendor\controller\GUsuario\GUsuarioValidate;
use vendor\controller\Log\LogSave;

/** Instânciamento de classes */
$GSequencia = new GSequencia();
$GUsuario = new GUsuario();
$GUsuarioValidate = new GUsuarioValidate();
$LogSave = new LogSave();

try
{

    /** Busco a sequencia atualizada */
    $resultGSequenciaServicoPedido = @(int)$GSequencia->Last('G_USUARIO', 'USUARIO_ID');

    /** Parâmetros de entrada */
    $GUsuarioValidate->setUsuarioId(@(int)$resultGSequenciaServicoPedido);
    $GUsuarioValidate->setLogin(@(string)$_POST['login']);
    $GUsuarioValidate->setSenha(@(string)$_POST['senha']);
    $GUsuarioValidate->setSituacao(@(string)$_POST['situacao']);
    $GUsuarioValidate->setNomeCompleto(@(string)$_POST['nome_completo']);
    $GUsuarioValidate->setFuncao(@(string)$_POST['funcao']);
    $GUsuarioValidate->setCpf(@(string)$_POST['cpf']);

    /** Controle de mensagens */
    $message = Array();

    /** Verifico a existência de erros */
    if (count($GUsuarioValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $GUsuarioValidate->getErrors(),

        ];

    }
    else
    {

        /** Verifico se o usuário foi localizado */
        if ($GUsuario->Save(@(int)$_POST['ACTION'], $GUsuarioValidate->getUsuarioId(), $GUsuarioValidate->getTrocarsenha(), $GUsuarioValidate->getLogin(), $GUsuarioValidate->getSenha(), $GUsuarioValidate->getSituacao(), $GUsuarioValidate->getNomeCompleto(), $GUsuarioValidate->getFuncao(), $GUsuarioValidate->getAssina(), $GUsuarioValidate->getSigla(), $GUsuarioValidate->getUltimoLoginRegs(), $GUsuarioValidate->getDataExpiracao(), $GUsuarioValidate->getSenhaAnterior(), $GUsuarioValidate->getAndamentoPadrao(), $GUsuarioValidate->getAndamentoPadrao2(), $GUsuarioValidate->getReceberMensagemArrolamento(), $GUsuarioValidate->getAssinaCertidao(), $GUsuarioValidate->getEmail(), $GUsuarioValidate->getReceberEmailPenhora(), $GUsuarioValidate->getFoto(), $GUsuarioValidate->getNaoReceberChatTodos(), $GUsuarioValidate->getPodeAlterarCaixa(), $GUsuarioValidate->getLembretePergunta(), $GUsuarioValidate->getLembreteResposta(), $GUsuarioValidate->getReceberChatCertidaoOnline(), $GUsuarioValidate->getReceberChatCancelamento(), $GUsuarioValidate->getCpf()))
        {

            /** Salvo o Histórico */
            $LogSave->Create('Usuário', 'O seguinte usuário solicitou acesso: <strong>' . $GUsuarioValidate->getNomeCompleto() . '</strong>,', date('d-m-Y'), date('H:m:s'), $_SERVER['REMOTE_ADDR'], 'badge-warning');

            /** Adição de elementos na array */
            array_push($message, array('sucesso', 'Usuário cadastrado com sucesso'));

            /** Result **/
            $result = [

                'cod' => 0,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&PRODUCT=GR&TABLE=GUSUARIO&ACTION=G_USUARIO_LOGIN',

            ];

        }
        else
        {

            /** Adição de elementos na array */
            array_push($message, array('erro', 'Não foi possivel salvar o registro'));

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
    array_push($message, array('erro', '<span class="badge badge-primary">Detalhes.:</span> ' . 'código = ' . $exception->getCode() . ' - linha = ' . $exception->getLine() . ' - arquivo = ' . $exception->getFile()));
    array_push($message, array('erro', '<span class="badge badge-primary">Mensagem.:</span> ' . $exception->getMessage()));

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