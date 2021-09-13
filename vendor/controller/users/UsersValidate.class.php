<?php

/** Defino o local da classes */

namespace vendor\controller\Users;

/** Importação de classes */
use vendor\model\Main;

class UsersValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = array();

    private $userId = null;
    private $nameFirst = null;
    private $nameLast = null;
    private $dateBirth = null;
    private $email = null;
    private $password = null;
    private $history = null;
    private $date = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setUserId(int $userId): void
    {

        /** Tratamento da informação */
        $this->userId = isset($userId) ? $this->Main->antiInjection($userId) : null;

        /** Validação da informação */
        if ($this->userId <= 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "User ID", deve ser válido');

        }

    }

    public function setNameFirst(string $nameFirst): void
    {

        /** Tratamento da informação */
        $this->nameFirst = isset($nameFirst) ? $this->Main->antiInjection($nameFirst) : null;

        /** Validação da informação */
        if (empty($this->nameFirst)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Primeiro Nome", deve ser válido');

        }

    }

    public function setNameLast(string $nameLast): void
    {

        /** Tratamento da informação */
        $this->nameLast = isset($nameLast) ? $this->Main->antiInjection($nameLast) : null;

        /** Validação da informação */
        if (empty($this->nameLast)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Último Nome", deve ser válido');

        }

    }

    public function setDateBirth(string $dateBirth): void
    {

        /** Tratamento da informação */
        $this->dateBirth = isset($dateBirth) ? $this->Main->antiInjection($dateBirth) : null;

        /** Validação da informação */
        if (empty($this->dateBirth)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Data de Nascimento", deve ser válido');

        }

    }

    public function setEmail(string $email): void
    {

        /** Tratamento da informação */
        $this->email = isset($email) ? $this->Main->antiInjection($email) : null;

        /** Validação da informação */
        if (empty($this->email)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Email", deve ser válido');

        }

    }

    public function setPassword(string $password): void
    {

        /** Tratamento da informação */
        $this->password = isset($password) ? $this->Main->antiInjection($password) : null;

        /** Validação da informação */
        if (empty($this->password)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Senha", deve ser válido');

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

    public function getUserId(): int
    {

        /** Retorno da informação */
        return (int)$this->userId;

    }

    public function getNameFirst(): string
    {

        /** Retorno da informação */
        return (string)$this->nameFirst;

    }

    public function getNameLast(): string
    {

        /** Retorno da informação */
        return (string)$this->nameLast;

    }

    public function getDateBirth(): string
    {

        /** Retorno da informação */
        return (string)$this->dateBirth;

    }

    public function getEmail(): string
    {

        /** Retorno da informação */
        return (string)$this->email;

    }

    public function getPassword(): string
    {

        /** Retorno da informação */
        return (string)$this->password;

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