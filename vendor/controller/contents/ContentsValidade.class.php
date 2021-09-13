<?php

/** Defino o local da classes */
namespace vendor\controller\contents;

/** Importação de classes */
use vendor\model\Main;

class ContentsValidade
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;

    private $contentId = null;
    private $contentCategoryId = null;
    private $highlighterId = null;
    private $situationId = null;
    private $userId = null;
    private $positionContent = null;
    private $positionMenu = null;
    private $url = null;
    private $title = null;
    private $titleMenu = null;
    private $description = null;
    private $contentResume = null;
    private $contentComplete = null;
    private $visited = null;
    private $dateStart = null;
    private $dateClosing = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

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

    public function setContentCategoryId(int $contentCategoryId): void
    {

        /** Tratamento da informação */
        $this->contentCategoryId = isset($contentCategoryId) ? $this->Main->antiInjection($contentCategoryId) : null;

        /** Validação da informação */
        if ($this->contentCategoryId <= 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Categoria de Conteúdo ID", deve ser válido');

        }

    }

    public function setHighlighters(int $highlighterId): void
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

    public function setPositionMenu(int $positionMenu): void
    {

        /** Tratamento da informação */
        $this->positionMenu = isset($positionMenu) ? $this->Main->antiInjection($positionMenu) : null;

    }

    public function setUrl(string $url): void
    {

        /** Tratamento da informação */
        $this->url = isset($url) ? $this->Main->antiInjection($url) : null;

    }

    public function setTitle(string $title): void
    {

        /** Tratamento da informação */
        $this->title = isset($title) ? $this->Main->antiInjection($title) : null;

        /** Validação da informação */
        if (empty($this->title)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Título", deve ser válido');

        }

    }

    public function setTitleMenu(string $titleMenu): void
    {

        /** Tratamento da informação */
        $this->titleMenu = isset($titleMenu) ? $this->Main->antiInjection($titleMenu) : null;

    }

    public function setDescription(string $description): void
    {

        /** Tratamento da informação */
        $this->description = isset($description) ? $this->Main->antiInjection($description) : null;

    }

    public function setContentResume(string $contentResume): void
    {

        /** Tratamento da informação */
        $this->contentResume = isset($contentResume) ? $this->Main->antiInjection($contentResume) : null;

    }

    public function setContentComplete(string $contentComplete): void
    {

        /** Tratamento da informação */
        $this->contentComplete = isset($contentComplete) ? $this->Main->antiInjection($contentComplete, 'S') : null;

    }

    public function setVisited(string $visited): void
    {

        /** Tratamento da informação */
        $this->visited = isset($visited) ? $this->Main->antiInjection($visited) : null;

    }

    public function setDateStart(string $dateStart): void
    {

        /** Tratamento da informação */
        $this->dateStart = isset($dateStart) ? $this->Main->antiInjection($dateStart) : null;

    }

    public function setDateClosing(string $dateClosing): void
    {

        /** Tratamento da informação */
        $this->dateClosing = isset($dateClosing) ? $this->Main->antiInjection($dateClosing) : null;

    }

    public function setHistory(string $history): void
    {

        /** Tratamento da informação */
        $this->history = isset($history) ? $this->Main->antiInjection($history) : null;

        /** Validação da informação */
        if (empty($this->history)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Histórico", deve ser válido');

        }

    }

    public function getContentId(): int
    {

        /** Retorno da informação */
        return (int)$this->contentId;

    }

    public function getContentCategoryId(): int
    {

        /** Retorno da informação */
        return (int)$this->contentCategoryId;

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

    public function getPositionMenu(): int
    {

        /** Retorno da informação */
        return (int)$this->positionMenu;

    }

    public function getUrl(): string
    {

        /** Retorno da informação */
        return (string)$this->url;

    }

    public function getTitle(): string
    {

        /** Retorno da informação */
        return (string)$this->title;

    }

    public function getTitleMenu(): string
    {

        /** Retorno da informação */
        return (string)$this->titleMenu;

    }

    public function getDescription(): string
    {

        /** Retorno da informação */
        return (string)$this->description;

    }

    public function getContentResume(): string
    {

        /** Retorno da informação */
        return (string)$this->contentResume;

    }

    public function getContentComplete(): string
    {

        /** Retorno da informação */
        return (string)$this->contentComplete;

    }

    public function getVisited(): string
    {

        /** Retorno da informação */
        return (string)$this->visited;

    }

    public function getDateStart(): string
    {

        /** Retorno da informação */
        return (string)$this->dateStart;

    }

    public function getDateClosing(): string
    {

        /** Retorno da informação */
        return (string)$this->dateClosing;

    }

    public function getHistory(): string
    {

        /** Retorno da informação */
        return (string)$this->history;

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