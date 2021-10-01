<?php

/** Defino o local da classes */
namespace vendor\controller\users_files;

/** Importação de classes */
use vendor\model\Main;

class UsersFilesValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;

    private $userFileId = null;
    private $userId = null;
    private $name = null;
    private $pathProfile = null;
    private $pathCover = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setUserFileId(int $userFileId): void
    {

        /** Tratamento da informação */
        $this->userFileId = isset($userFileId) ? $this->Main->antiInjection($userFileId) : null;

        /** Validação da informação */
        if ($this->userFileId < 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "User File ID", deve ser válido');

        }

    }

    public function setUserId(int $userId): void
    {

        /** Tratamento da informação */
        $this->userId = isset($userId) ? $this->Main->antiInjection($userId) : null;

        /** Validação da informação */
        if ($this->userId <= 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Usuário ID", deve ser válido');

        }

    }

    public function setName(string $name): void
    {

        /** Tratamento da informação */
        $this->name = isset($name) ? $this->Main->antiInjection($name) : null;

    }

    public function setPathProfile(string $pathProfile): void
    {

        /** Tratamento da informação */
        $this->pathProfile = isset($pathProfile) ? $this->Main->antiInjection($pathProfile) : null;

    }

    public function setPathCover(string $pathCover): void
    {

        /** Tratamento da informação */
        $this->pathCover = isset($pathCover) ? $this->Main->antiInjection($pathCover) : null;

    }

    public function getUserFileId(): int
    {

        /** Retorno da informação */
        return (int)$this->userFileId;

    }

    public function getUserId(): int
    {

        /** Retorno da informação */
        return (int)$this->userId;

    }

    public function getName(): string
    {

        /** Retorno da informação */
        return (string)$this->name;

    }

    public function getPathProfile(): string
    {

        /** Retorno da informação */
        return (string)$this->pathProfile;

    }

    public function getPathCover(): string
    {

        /** Retorno da informação */
        return (string)$this->pathCover;

    }

    public function getFullPathProfile(): string
    {

        /** Retorno da informação */
        return (string)$this->pathProfile . '/' . (string)$this->name;

    }

    public function getFullPathCover(): string
    {

        /** Retorno da informação */
        return (string)$this->pathCover . '/' . (string)$this->name;

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