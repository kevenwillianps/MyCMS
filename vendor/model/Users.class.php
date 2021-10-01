<?php/** Defino o local onde esta a classe */namespace vendor\model;class users{    /** Declaro as variavéis da classe */    private $connection = null;    private $sql = null;    private $stmt = null;    private $userId = null;    private $nameFirst = null;    private $nameLast = null;    private $dateBirth = null;    private $email = null;    private $password = null;    private $history = null;    /** Construtor da classe */    function __construct()    {        /** Cria o objeto de conexão com o banco de dados */        $this->connection = new MySql();    }    /** Busco um registro especifico para realizar acesso */    public function Access(string $email, string $password)    {        /** Parâmetros de entrada */        $this->email = $email;        $this->password = $password;        /** Consulta SQL */        $this->sql = 'SELECT * FROM users                       WHERE `email` LIKE :email                       AND `password` LIKE :password                       ORDER BY user_id DESC LIMIT 1';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preencho os parâmetros do SQL */        $this->stmt->bindParam(':email', $this->email);        $this->stmt->bindParam(':password', $this->password);        /** Executo o SQL */        $this->stmt->execute();        /** Retorno o resultado */        return $this->stmt->fetchObject();    }    /** Salvo o histórico do registro */    public function SaveHistory(int $userId, string $history): bool    {        /** Parâmetros de Entrada */        $this->userId = $userId;        $this->history = $history;        /** Consulta SQL*/        $this->sql = 'UPDATE users SET HISTORY = :history WHERE user_id = :userId';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':history', $this->history);        $this->stmt->bindParam(':userId', $this->userId);        /** Executo o SQL */        return $this->stmt->execute();    }    /** Busco um registro especifico para realizar acesso */    public function All()    {        /** Consulta SQL */        $this->sql = 'SELECT                      user_id,                      name_first,                      name_last,                      (SELECT COUNT(content_id) FROM contents WHERE user_id = user_id) AS quantity_contents,                      (SELECT COUNT(content_sub_id) FROM contents_subs WHERE user_id = user_id) AS quantity_contents_subs                      FROM users                       ORDER BY user_id ASC;';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Executo o SQL */        $this->stmt->execute();        /** Retorno o resultado */        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);    }    /** Salvo ou atualizo um registro */    public function Save(int $userId, string $nameFirst, string $nameLast, string $dateBirth, string $email, string $password, string $history): bool    {        /** Parâmetros de Entrada */        $this->userId = $userId;        $this->nameFirst = $nameFirst;        $this->nameLast = $nameLast;        $this->dateBirth = $dateBirth;        $this->email = $email;        $this->password = $password;        $this->history = $history;        /** Verifico o tipo de operação */        if ($this->userId === 0)        {            /** Consulta SQL */            $this->sql = 'INSERT INTO users(user_id,                                            name_first,                                            name_last,                                            date_birth,                                            email,                                            password,                                            history)                                      VALUES(:userId,                                             :nameFirst,                                             :nameLast,                                             :dateBirth,                                             :email,                                             :password,                                             :history);';        }        else        {            /** Consulta SQL */            $this->sql = 'UPDATE users SET                           name_first = :nameFirst,                          name_last = :nameLast,                          date_birth = :dateBirth,                          email = :email,                          password = :password,                          history = :history                          WHERE user_id = :userId';        }        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':userId', $this->userId);        $this->stmt->bindParam(':nameFirst', $this->nameFirst);        $this->stmt->bindParam(':nameLast', $this->nameLast);        $this->stmt->bindParam(':dateBirth', $this->dateBirth);        $this->stmt->bindParam(':email', $this->email);        $this->stmt->bindParam(':password', $this->password);        $this->stmt->bindParam(':history', $this->history);        /** Executo o SQL */        return $this->stmt->execute();    }    /** Busco um registro especifico para realizar acesso */    public function Get(int $userId)    {        /** Parâmetros de Entrada */        $this->userId = $userId;        /** Consulta SQL */        $this->sql = 'SELECT * FROM users WHERE user_id = :userId;';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':userId', $this->userId);        /** Executo o SQL */        $this->stmt->execute();        /** Retorno o resultado */        return $this->stmt->fetchObject();    }    /** Busco um registro especifico para realizar acesso */    public function GetProfile(int $userId)    {        /** Parâmetros de Entrada */        $this->userId = $userId;        /** Consulta SQL */        $this->sql = 'SELECT * FROM users u                      JOIN users_files uf ON u.user_id = uf.user_id                      WHERE u.user_id = :userId;';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':userId', $this->userId);        /** Executo o SQL */        $this->stmt->execute();        /** Retorno o resultado */        return $this->stmt->fetchObject();    }    /** Busco um registro especifico para realizar acesso */    public function GetByEmail(string $email)    {        /** Parâmetros de Entrada */        $this->email = $email;        /** Consulta SQL */        $this->sql = 'SELECT * FROM users WHERE email = :email ORDER BY user_id DESC LIMIT 1;';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':email', $this->email);        /** Executo o SQL */        $this->stmt->execute();        /** Retorno o resultado */        return $this->stmt->fetchObject();    }    /** Busco um registro especifico para realizar acesso */    public function Delete(int $userId)    {        /** Parâmetros de Entrada */        $this->userId = $userId;        /** Consulta SQL */        $this->sql = 'DELETE FROM users WHERE user_id = :userId;';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':userId', $this->userId);        /** Executo o SQL */        return $this->stmt->execute();    }    /** Fecha uma conexão aberta anteriormente com o banco de dados */    function __destruct()    {        $this->connection = null;    }}