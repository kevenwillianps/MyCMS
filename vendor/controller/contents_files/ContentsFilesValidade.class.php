<?php

/** Defino o local da classes */
namespace vendor\controller\contents_files;

/** Importação de classes */
use vendor\model\Main;

class ContentsFilesValidade
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;

    private $contentFileId = null;
    private $contentId = null;
    private $highlighterId = null;
    private $situationId = null;
    private $userId = null;
    private $positionContent = null;
    private $name = null;
    private $path = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setContentFileId(int $contentFileId): void
    {

        /** Tratamento da informação */
        $this->contentFileId = isset($contentFileId) ? $this->Main->antiInjection($contentFileId) : null;

        /** Validação da informação */
        if ($this->contentFileId < 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Conteúdo Arquivo ID", deve ser válido');

        }

    }

    public function setContentId(int $contentId): void
    {

        /** Tratamento da informação */
        $this->contentId = isset($contentId) ? $this->Main->antiInjection($contentId) : null;

        /** Validação da informação */
        if ($this->contentId < 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Conteúdo ID", deve ser válido');

        }

    }

    public function setHighlighterId(int $highlighterId): void
    {

        /** Tratamento da informação */
        $this->highlighterId = isset($highlighterId) ? $this->Main->antiInjection($highlighterId) : null;

        /** Validação da informação */
        if ($this->highlighterId <= 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Marcador", deve ser válido');

        }

    }

    public function setSituationId(int $situationId): void
    {

        /** Tratamento da informação */
        $this->situationId = isset($situationId) ? $this->Main->antiInjection($situationId) : null;

        /** Validação da informação */
        if ($this->situationId <= 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Situação ID", deve ser válido');

        }

    }

    public function setUserId(int $userId): void
    {

        /** Tratamento da informação */
        $this->userId = isset($userId) ? $this->Main->antiInjection($userId) : null;

        /** Validação da informação */
        if ($this->userId <= 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Usuário ID", deve ser válido');

        }

    }

    public function setPositionContent(int $positionContent): void
    {

        /** Tratamento da informação */
        $this->positionContent = isset($positionContent) ? $this->Main->antiInjection($positionContent) : null;

    }

    public function setName(string $name): void
    {

        /** Tratamento da informação */
        $this->name = isset($name) ? $this->Main->antiInjection($name) : null;

    }

    public function setPath(string $path): void
    {

        /** Tratamento da informação */
        $this->path = isset($path) ? $this->Main->antiInjection($path) : null;

    }

    public function getContentFileId(): int
    {

        /** Retorno da informação */
        return (int)$this->contentFileId;

    }

    public function getContentId(): int
    {

        /** Retorno da informação */
        return (int)$this->contentId;

    }

    public function getHighlighterId(): int
    {

        /** Retorno da informação */
        return (int)$this->highlighterId;

    }

    public function getSituationId(): int
    {

        /** Retorno da informação */
        return (int)$this->situationId;

    }

    public function getUserId(): int
    {

        /** Retorno da informação */
        return (int)$this->userId;

    }

    public function getPositionContent(): int
    {

        /** Retorno da informação */
        return (int)$this->positionContent;

    }

    public function getName(): string
    {

        /** Retorno da informação */
        return (string)$this->name;

    }

    public function getPath(): string
    {

        /** Retorno da informação */
        return (string)$this->path;

    }

    public function getFullPath(): string
    {

        /** Retorno da informação */
        return (string)$this->path . '/' . (string)$this->name;

    }

    public function getErrors(): string
    {

        /** Verifico se deve informar os erros */
        if (count($this->errors)) {

            /** Verifica a quantidade de erros para informar a legenda */
            $this->info = count($this->errors) > 1 ? 'Os seguintes erros foram encontrados:' : 'O seguinte erro foi encontrado:';

            /** Lista os erros  */
            foreach ($this->errors as $keyError => $error) {

                /** Monto a mensagem de erro */
                $this->info .= '</br>' . ($keyError + 1) . ' - ' . $error;

            }

            /** Retorno os erros encontrados */
            return (string)$this->info;

        } else {

            return false;

        }

    }

}