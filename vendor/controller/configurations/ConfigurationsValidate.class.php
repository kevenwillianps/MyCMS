<?php

/** Defino o local da classes */
namespace vendor\controller\configurations;

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
    private $copyright = null;
    private $author = null;
    private $description = null;
    private $keywords = null;
    private $preferences = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setConfigurationId(int $configurationId) : void
    {

        /** Tratamento da informação */
        $this->configurationId = isset($configurationId) ? $this->Main->antiInjection($configurationId) : null;

    }

    public function setTitle(string $title) : void
    {

        /** Tratamento da informação */
        $this->title = isset($title) ? $this->Main->antiInjection($title) : null;

        /** Validação da informação */
        if (empty($this->title))
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Título", deve ser preenchido');

        }

    }

    public function setCopyright(string $copyright) : void
    {

        /** Tratamento da informação */
        $this->copyright = isset($copyright) ? $this->Main->antiInjection($copyright) : null;

        /** Validação da informação */
        if (empty($this->copyright))
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Copyright", deve ser preenchido');

        }

    }

    public function setAuthor(string $author) : void
    {

        /** Tratamento da informação */
        $this->author = isset($author) ? $this->Main->antiInjection($author) : null;

        /** Validação da informação */
        if (empty($this->author))
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Autor", deve ser preenchido');

        }

    }

    public function setDescription(string $description) : void
    {

        /** Tratamento da informação */
        $this->description = isset($description) ? $this->Main->antiInjection($description) : null;

        /** Validação da informação */
        if (empty($this->description))
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Descrição", deve ser preenchido');

        }

    }

    public function setKeywords(string $keywords) : void
    {

        /** Tratamento da informação */
        $this->keywords = isset($keywords) ? $this->Main->antiInjection($keywords) : null;

        /** Validação da informação */
        if (empty($this->keywords))
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Palavras Chaves", deve ser preenchido');

        }

    }

    public function setPreferences(string $preferences) : void
    {

        /** Tratamento da informação */
        $this->preferences = isset($preferences) ? $this->Main->antiInjection($preferences) : null;

    }

    public function setHistory(string $history) : void
    {

        /** Tratamento da informação */
        $this->history = isset($history) ? $this->Main->antiInjection($history) : null;

    }

    public function getConfigurationId() : int
    {

        /** Retorno da informação */
        return (int)$this->configurationId;

    }

    public function getTitle() : string
    {

        /** Retorno da informação */
        return $this->title;

    }

    public function getCopyright() : string
    {

        /** Retorno da informação */
        return $this->copyright;

    }

    public function getAuthor() : string
    {

        /** Retorno da informação */
        return $this->author;

    }

    public function getDescription() : string
    {

        /** Retorno da informação */
        return $this->description;

    }

    public function getKeywords() : string
    {

        /** Retorno da informação */
        return $this->keywords;

    }

    public function getPreferences() : string
    {

        /** Retorno da informação */
        return (string)$this->preferences;

    }

    public function getHistory() : string
    {

        /** Retorno da informação */
        return $this->history;

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