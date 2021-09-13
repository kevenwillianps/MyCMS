<?php

/** Defino o local da classes */
namespace vendor\controller\Configurations;

/** Importação de classes */
use vendor\model\Main;

class ConfigurationsValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;

    private $configurationId = null;
    private $title = null;
    private $description = null;
    private $keywords = null;
    private $author = null;
    private $copyright = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setConfigurationId(int $configurationId): void
    {

        /** Tratamento da informação */
        $this->configurationId = isset($configurationId) ? $this->Main->antiInjection($configurationId) : null;

        /** Validação da informação */
        if ($this->configurationId < 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Configuração ID", deve ser válido');

        }

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

    public function setKeywords(string $keywords): void
    {

        /** Tratamento da informação */
        $this->keywords = isset($keywords) ? $this->Main->antiInjection($keywords) : null;

        /** Validação da informação */
        if (empty($this->keywords)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Palavras Chaves", deve ser válido');

        }

    }

    public function setAuthor(string $author): void
    {

        /** Tratamento da informação */
        $this->author = isset($author) ? $this->Main->antiInjection($author) : null;

        /** Validação da informação */
        if (empty($this->author)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Autor", deve ser válido');

        }

    }

    public function setCopyright(string $copyright): void
    {

        /** Tratamento da informação */
        $this->copyright = isset($copyright) ? $this->Main->antiInjection($copyright) : null;

        /** Validação da informação */
        if (empty($this->copyright)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Copyright", deve ser válido');

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

    public function getConfigurationId(): int
    {

        /** Retorno da informação */
        return (int)$this->configurationId;

    }

    public function getTitle(): string
    {

        /** Retorno da informação */
        return (string)$this->title;

    }

    public function getDescription(): string
    {

        /** Retorno da informação */
        return (string)$this->description;

    }

    public function getKeywords(): string
    {

        /** Retorno da informação */
        return (string)$this->keywords;

    }

    public function getAuthor(): string
    {

        /** Retorno da informação */
        return (string)$this->author;

    }

    public function getCopyright(): string
    {

        /** Retorno da informação */
        return (string)$this->copyright;

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