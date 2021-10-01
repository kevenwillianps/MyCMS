<?php

/** Defino o local da classes */
namespace vendor\controller\contacts;

/** Importação de classes */
use vendor\model\Main;

class ContactsValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;

    private $contactId = null;
    private $name = null;
    private $email = null;
    private $cellphone = null;
    private $subject = null;
    private $message = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setContactId(int $contactId) : void
    {

        $this->contactId = isset($contactId) ? $this->Main->antiInjection($contactId) : null;

    }

    public function setName(string $name) : void
    {

        $this->name = isset($name) ? $this->Main->antiInjection($name) : null;

    }

    public function setEmail(string $email) : void
    {

        $this->email = isset($email) ? $this->Main->antiInjection($email) : null;

    }

    public function setCellphone(string $cellphone) : void
    {

        $this->cellphone = isset($cellphone) ? $this->Main->antiInjection($cellphone) : null;

    }

    public function setSubject(string $subject) : void
    {

        $this->subject = isset($subject) ? $this->Main->antiInjection($subject) : null;

    }

    public function setMessage(string $message) : void
    {

        $this->message = isset($message) ? $this->Main->antiInjection($message) : null;

    }

    public function getContactId() : int
    {

        return (int)$this->contactId;

    }

    public function getName() : string
    {

        return (string)$this->name;

    }

    public function getEmail() : string
    {

        return (string)$this->email;

    }

    public function getCellphone() : string
    {

        return (string)$this->cellphone;

    }

    public function getSubject() : string
    {

        return (string)$this->subject;

    }

    public function getMessage() : string
    {

        return (string)$this->message;

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