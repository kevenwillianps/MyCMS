<?php

/** Defino o local da classes */
namespace vendor\controller\configurations;

/** Importação de classes */
use vendor\model\Main;

class ConfigurationsImagePreferenceValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;

    private $indice = null;
    private $name = null;
    private $width = null;
    private $height = null;
    private $quality = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setIndice(int $indice) : void
    {

        $this->indice = isset($indice) ? $this->Main->antiInjection($indice) : null;

    }

    public function setName(string $name) : void
    {

        $this->name = isset($name) ? $this->Main->antiInjection($name) : null;

    }

    public function setWidth(int $width) : void
    {

        $this->width = isset($width) ? $this->Main->antiInjection($width) : null;

    }

    public function setHeight(int $height) : void
    {

        $this->height = isset($height) ? $this->Main->antiInjection($height) : null;

    }

    public function setQuality(int $quality) : void
    {

        $this->quality = isset($quality) ? $this->Main->antiInjection($quality) : null;

    }

    public function getIndice() : int
    {

        return (int)$this->indice;

    }

    public function getName() : string
    {

        return (string)$this->name;

    }

    public function getWidth() : int
    {

        return (int)$this->width;

    }

    public function getHeight() : int
    {

        return (int)$this->height;

    }

    public function getQuality() : int
    {

        return (int)$this->quality;

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