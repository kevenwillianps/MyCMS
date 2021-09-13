<?php

namespace vendor\controller\File;

class File{

    /** Parâmetros da Classes */
    private $year = null;
    private $month = null;
    private $day = null;
    private $path = null;
    private $document = null;
    private $wideImage = null;

    private $name = null;
    private $base64 = null;
    private $highlighter_id = null;
    private $extension = null;

    /** Método Construtor */
    public function __construct($string)
    {

        /** Pego o ano atual **/
        $this->year = date('Y');

        /** Pego o mês atual **/
        $this->month = date('m');

        /** Pego o dia atual **/
        $this->day = date('d');

        /** Caminho raiz dos documentos **/
        $this->path = "document/{$string}";

        /** Instanciamento do manipulador da imagem **/
        $this->wideImage = new \WideImage();

    }

    /** Crio o arquivo em disco */
    public function generate($name, $base64)
    {

        /** Parâmetros de entrada */
        $this->name = $name;
        $this->base64 = $base64;

        /** Verifico se já existe alguma pasta */
        if (is_dir($this->path))
        {

            /** Crio meu arquivo e escrevo dentro dele **/
            $this->document = fopen($this->path . '/' . $this->name, 'a+');

            /** Escrevo dentro do arquivo **/
            fwrite($this->document, base64_decode($this->base64));

            /** Encerro a escrita do arquivo **/
            fclose($this->document);

        }
        else
        {

            /** Crio o caminho **/
            mkdir($this->path, 0777, true);

            /** Crio meu arquivo e escrevo dentro dele **/
            $this->document = fopen($this->path . '/' . $this->name, 'a+');

            /** Crio meu arquivo e escrevo dentro dele **/
            fwrite($this->document, base64_decode($this->base64));

            /** Encerro a escrita do arquivo **/
            fclose($this->document);

        }

        /** Verifico se o arquivo foi criado */
        if (is_file($this->path . '/' . $this->name))
        {

            return true;

        }
        else
        {

            return false;

        }

    }

    /** Retorno o caminho do arquivo */
    public function path($name)
    {

        /** Retorno o caminho */
        return $this->path . '/' . $name;

    }

    /** Retorno o caminho do arquivo */
    public function pathJust()
    {

        /** Retorno o caminho */
        return $this->path;

    }

    public function handling($path, $highlighter_id)
    {

        /** Parâmetros de entrada **/
        $this->path = (string)$path;
        $this->highlighter_id = (int)$highlighter_id;
        $this->extension = pathinfo($path, PATHINFO_EXTENSION);

        if ($this->extension === 'mp4')
        {

            return;

        }

        /** Verifico se é capa */
        if ($highlighter_id == 1)
        {

            /** Corto a imagem para icone **/
            $this->wideImage = \WideImage::load($path);
            $this->wideImage = $this->wideImage->resize(1920, 350, 'outside');
            $this->wideImage = $this->wideImage->crop('center', 'center', 1920, 350);
            $this->wideImage = $this->wideImage->saveToFile($path, $this->extension == 'png' ? 4 : 60);

        }
        elseif ($highlighter_id == 2) /** Verifico se é perfil */
        {

            /** Corto a imagem para icone **/
            $this->wideImage = \WideImage::load($path);
            $this->wideImage = $this->wideImage->resize(500, 500, 'outside');
            $this->wideImage = $this->wideImage->crop('center', 'center', 500, 500);
            $this->wideImage = $this->wideImage->saveToFile($path, $this->extension == 'png' ? 4 : 60);

        }
        elseif ($highlighter_id == 3) /** Verifico se é miniatura */
        {

            /** Corto a imagem para icone **/
            $this->wideImage = \WideImage::load($path);
            $this->wideImage = $this->wideImage->resize(720, 720, 'outside');
            $this->wideImage = $this->wideImage->crop('center', 'center', 720, 350);
            $this->wideImage = $this->wideImage->saveToFile($path, $this->extension == 'png' ? 4 : 60);

        }

    }

    /** Método Destrutor */
    public function __destruct()
    {

        /** Limpo o ano atual */
        $this->year = null;

        /** Limpo o mês atual */
        $this->month = null;

        /** Limpo o dia atual */
        $this->day = null;

        /** Limpo o caminho atual */
        $this->path = null;

        /** Limpo o documento atual */
        $this->document = null;

        /** Finalizo o instanciamento do manipulador da imagem **/
        $this->wideImage = null;

        /** Limpo o nome da imagem */
        $this->name = null;

        /** Limpo o arquivo da imagem */
        $this->base64 = null;

    }

}