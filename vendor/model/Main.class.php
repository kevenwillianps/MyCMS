<?php

/** Defino o local onde a classe esta localizada **/
namespace vendor\model;

class Main
{

    private $string = null;
    private $long = null;
    private $elements = null;
    private $data = null;
    private $resultConfig = null;
    private $usuario_publico_id = null;

    private $path = null;
    private $file = null;

    /** Finalizo a sessão */
    public function SessionStart()
    {

        session_start();

    }

    /** Finalizo a sessão */
    public function SessionDestroy()
    {

        session_destroy();

    }

    /** Função para carregar as informações */
    public function LoadConfigPublic()
    {

        /** Carrego o arquivo de configuração */
        return (object)json_decode(file_get_contents('config.json'));

    }

    /** Verifico se o usuário esta logado */
    public function checkSession(){

        /** Salvo minha variavel **/
        $this->usuario_publico_id = @(string)$_SESSION['USUARIO_PUBLICO_CPF'];

        /** Retorno verdadeiro ou falso **/
        if (!empty(trim($this->usuario_publico_id))){

            return true;

        }else{

            return false;

        }

    }

    /** Tratamento de Strings */
    public function antiInjection($string, string $long = '')
    {

        /** Parâmetros de entrada */
        $this->string = $string;
        $this->long = $long;

        /** Verifico o tipo de entrada */
        if (is_array($this->string)) {

            /** Retorno o texto sem formatação */
            return $this->string;

        } elseif (strcmp($this->long, 'S') === 0) {

            /** Retorno a string sem tratamento */
            return utf8_decode($this->string);

        } else {

            /** Remoção de espaçamentos */
            $this->string = trim($this->string);

            /** Remoção de tags PHP e HTML */
            $this->string = strip_tags($this->string);

            /** Adição de barras invertidas */
            $this->string = addslashes($this->string);

            /** Evita ataque XSS */
            $this->string = htmlspecialchars($this->string);

            /** Elementos do SQL Injection */
            $elements = array(
                'drop',
                'select',
                'delete',
                'update',
                'insert',
                'alert',
                'destroy',
                '*',
                'database',
                'drop',
                'union',
                'TABLE_NAME',
                '1=1',
                'or 1',
                'exec',
                'INFORMATION_SCHEMA',
                'like',
                'COLUMNS',
                'into',
                'VALUES',
                'from',
                'undefined'
            );

            /** Transformo as palavras em array */
            $palavras = explode(' ', str_replace(',', '', $this->string));

            /** Percorro todas as palavras localizadas */
            foreach ($palavras as $keyPalavra => $palavra)
            {

                /** Percorro todos os elementos do SQL Injection */
                foreach ($elements as $keyElement => $element)
                {

                    /** Verifico se a palavra esta na lista negra */
                    if (strcmp(strtolower($palavra), strtolower($element)) === 0) {

                        /** Realizo a troca da marcação pela palavra qualificada */
                        $this->string = str_replace($palavra, '', $this->string);

                    }

                }

            }

            /** Retorno o texto tratado */
            return utf8_decode($this->string);

        }

    }

    /** Removedor de mascaras */
    public function removeMask($string)
    {

        /** Elementos para serem removidos da String */
        $this->elements = ['(', ')', '.', '-', '/'];

        /** Parâmetros de entrada */
        $this->string = $string;

        /** Remoção dos elementos */
        $this->string = str_replace($this->elements, '', $this->string);

        return $this->string;

    }

    public function CentimeterToPoint($centimeter)
    {

        return $centimeter * 28.34645669;

    }

    public function getBase64(string $data)
    {

        /** Parâmetros de entrada */
        $this->data = $data;

        /** Retorno a sequencia */
        return base64_encode(file_get_contents($this->data));

    }

    /** Extraio as marcações do texto */
    public function getMarcacoes(string $string) : array
    {

        /** Parâmetros de entrada */
        $this->string = $string;

        /** Busco as marcações para substituição */
        preg_match_all("#\[[\w\s']+\]#i", $this->string, $palavras);

        /** Retorno a sequencia */
        return (array)$palavras[0];

    }

    /** Função para gerar arquivos em disco */
    public function generateFile(string $path, string $file, array $data) : bool
    {

        /** Parâmetros de entrada */
        $this->path = $path;
        $this->file = $file;
        $this->data = $data;

        /** Verifico se o diretório existe */
        if (!is_dir($this->path))
        {

            /** Crio o diretório */
            mkdir($this->path, 0755, true);

        }

        /** Crio o Arquivo Para Escrita */
        $path = fopen($this->path . $this->file,'w+');

        /** Escrevo Dentro do Arquivo */
        fwrite($path, json_encode($this->data, JSON_PRETTY_PRINT));

        /** Encerro a Escrita do Arquivo */
        fclose($path);

        /** Verifico se o arquivo foi criado */
        if (file_exists($this->path . $this->file))
        {

            return true;

        }
        else
        {

            return false;

        }

    }

}

