<?php

/** Defino o local da classes */
namespace vendor\controller\content_categories;

/** Importação de classes */
use vendor\model\Main;

class ContentCategoriesValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;

    private $contentCategoryId = null;
    private $situationId = null;
    private $userId = null;
    private $name = null;
    private $description = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setContentCategoryId(int $contentCategoryId): void
    {

        /** Tratamento da informação */
        $this->contentCategoryId = isset($contentCategoryId) ? $this->Main->antiInjection($contentCategoryId) : null;

        /** Validação da informação */
        if ($this->contentCategoryId < 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Categoria de Conteúdo ID", deve ser válido');

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

    public function setName(string $name): void
    {

        /** Tratamento da informação */
        $this->name = isset($name) ? $this->Main->antiInjection($name) : null;

        /** Validação da informação */
        if (empty($this->name)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Nome", deve ser válido');

        }

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

    public function setDescription(string $description): void
    {

        /** Tratamento da informação */
        $this->description = isset($description) ? $this->Main->antiInjection($description) : null;

        /** Validação da informação */
        if (empty($this->description)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Descrição", deve ser válido');

        }

    }

    public function getContentCategoryId(): int
    {

        /** Retorno da informação */
        return (int)$this->contentCategoryId;

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

    public function getName(): string
    {

        /** Retorno da informação */
        return (string)$this->name;

    }

    public function getDescription(): string
    {

        /** Retorno da informação */
        return (string)$this->description;

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