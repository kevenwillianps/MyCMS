<?php

/** Defino o local onde a classe esta localizada **/
namespace vendor\model;

class Host
{

    /** Parâmetros da Classe */
    private $Main;
    private $configPublico;

    /** Contrutor da Classe */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

        /** Operações */
        $this->configPublico = $this->Main->LoadConfigPublic();

    }

    /** Pego a localização do banco de dados **/
    public function getDsn()
    {

        return $dsn = 'mysql:port=3306;dbname=' . (string)$this->configPublico->database->name;

    }

    /** Pego o usuário de acesso **/
    public function getUser()
    {
        return $user = (string)$this->configPublico->database->user;
    }

    /** Pego a senha de acesso **/
    public function getPassword()
    {
        return $password = (string)$this->configPublico->database->password;
    }

    /** Pego o charset de acesso **/
    public function getCharset()
    {
        return $charset = (string)$this->configPublico->database->charset;
    }

    /** Contrutor da Classe */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->Main = null;

    }

}
