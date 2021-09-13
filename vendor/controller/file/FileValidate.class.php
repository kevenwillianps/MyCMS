<?php

/** Defino o local da classes */
namespace vendor\controller\File;

/** Importação de classess */
use \vendor\model\Main;

class FileValidate
{

    /** Variáveis da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;
    
    private $name;
    private $base64;
    private $ponteiro;
    private $tamanho;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setName(string $name) : void
    {

        /** Tratamento dos dados de entrada */
        $this->name = isset($name) ? $this->Main->antiInjection($name) : null;

        /** Validação dos dados */
        if (empty($this->name))
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Nome", deve ser preenchido');

        }

    }

    public function setBase64(string $base64) : void
    {

        /** Tratamento dos dados de entrada */
        $this->base64 = isset($base64) ? $this->Main->antiInjection(str_replace(' ', '+', $base64)) : null;

        /** Validação dos dados */
        if (empty($this->base64))
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "base64", deve ser preenchido');

        }

    }

    public function setPonteiro(int $ponteiro) : void
    {

        /** Tratamento dos dados de entrada */
        $this->ponteiro = isset($ponteiro) ? $this->Main->antiInjection($ponteiro) : null;

        /** Validação dos dados */
        if ($this->ponteiro < 0)
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Ponteiro", deve ser preenchido');

        }

    }

    public function setTamanho(string $tamanho) : void
    {

        /** Tratamento dos dados de entrada */
        $this->tamanho = isset($tamanho) ? (int)$this->Main->antiInjection($tamanho) : null;

        /** Validação dos dados */
        if (empty($this->tamanho))
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Tamanho", deve ser preenchido');

        }

    }

    public function getName() : string
    {

        /** Retorno da informação */
        return (string)$this->name;

    }

    public function getBase64() : string
    {

        /** Retorno da informação */
        return (string)$this->base64;

    }

    public function getPonteiro() : int
    {

        /** Retorno da informação */
        return (int)$this->ponteiro;

    }

    public function getTamanho() : int
    {

        /** Retorno da informação */
        return (int)$this->tamanho;

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

    /** Método destrutor */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->main = null;

    }

}
