<?php

namespace vendor\controller\File;

class File{

    /** Parâmetros da Classes */
    private $path = null;
    private $preferences = null;
    private $document = null;
    private $wideImage = null;

    private $name = null;
    private $base64 = null;

    /** Método Construtor */
    public function __construct()
    {

        /** Instanciamento do manipulador da imagem **/
        $this->wideImage = new \WideImage();

    }

    /** Crio o arquivo em disco */
    public function generate(string $path, string $name, string $base64) : bool
    {

        /** Parâmetros de entrada */
        $this->path = $path;
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

    public function handling(string $path, string $name, array $preferences) : void
    {

        /** Parâmetros de entrada **/
        $this->path = $path;
        $this->name = $name;
        $this->preferences = $preferences;

        /** Listagem de Todos os Registros */
        foreach ($this->preferences as $keyPreference => $preference)
        {

            /** Pego a extensão do arquivo */
            $extension = pathinfo($this->path . '/' . $preference->name . '/' . $this->name, PATHINFO_EXTENSION);

            /** Verifico se já existe alguma pasta */
            if (!is_dir($this->path . '/' . $preference->name))
            {

                /** Crio o caminho **/
                mkdir($this->path . '/' . $preference->name, 0777, true);

            }

            /** Corto a imagem para icone **/
            $this->wideImage = \WideImage::load($this->path . '/' . $this->name);
            $this->wideImage = $this->wideImage->resize($preference->width, $preference->height, 'outside');
            $this->wideImage = $this->wideImage->crop('center', 'center', $preference->width, $preference->height);
            $this->wideImage = $this->wideImage->saveToFile($this->path . '/' . $preference->name . '/' . $this->name, ($extension === 'png' ? $preference->quality_png : $preference->quality_jpg));

        }

    }

    /** Método Destrutor */
    public function __destruct()
    {

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