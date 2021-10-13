<?php

/** Defino o local da classes */
namespace vendor\controller\users_permissions;

/** Importação de classes */
use vendor\model\Main;

class UsersPermissionsValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;

    private $userPermissionId = null;
    private $name = null;
    private $description = null;
    private $permissions = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setUserPermissionId(int $userPermissionId): void
    {

        /** Tratamento da informação */
        $this->userPermissionId = isset($userPermissionId) ? $this->Main->antiInjection($userPermissionId) : null;

        /** Validação da informação */
        if ($this->userPermissionId < 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "User Permission ID", deve ser válido');

        }

    }

    public function setName(string $name): void
    {

        /** Tratamento da informação */
        $this->name = isset($name) ? $this->Main->antiInjection($name) : null;

        /** Validação da informação */
        if (empty($this->name)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Nome", deve ser válido');

        }

    }

    public function setDescription(string $description): void
    {

        /** Tratamento da informação */
        $this->description = isset($description) ? $this->Main->antiInjection($description) : null;

        /** Validação da informação */
        if (empty($this->description)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Descrição", deve ser válido');

        }

    }

    public function setPermissions(string $permissions): void
    {

        /** Tratamento da informação */
        $this->permissions = isset($permissions) ? $this->Main->antiInjection($permissions) : null;

    }

    public function getUserPermissionId(): int
    {

        /** Retorno da informação */
        return (int)$this->userPermissionId;

    }

    public function getName(): string
    {

        /** Retorno da informação */
        return (string)$this->name;

    }

    public function getDescription(): string
    {

        /** Retorno da informação */
        return (string)$this->description;

    }

    public function getPermissions(): string
    {

        /** Retorno da informação */
        return (string)$this->permissions;

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