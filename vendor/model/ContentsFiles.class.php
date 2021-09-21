<?php/** Defino o local onde esta a classe */namespace vendor\model;class ContentsFiles{    /** Declaro as variavéis da classe */    private $connection = null;    private $sql = null;    private $stmt = null;    private $contentFileId = null;    private $contentId = null;    private $highlighterId = null;    private $situationId = null;    private $userId = null;    private $positionContent = null;    private $name = null;    private $path = null;    /** Construtor da classe */    function __construct()    {        /** Cria o objeto de conexão com o banco de dados */        $this->connection = new MySql();    }    /** Salvo ou atualizo um registro */    public function Save(int $contentFileId, int $contentId, int $highlighterId, int $situationId, int $userId, int $positionContent, string $name, string $path): bool    {        /** Parâmetros de Entrada */        $this->contentFileId = $contentFileId;        $this->contentId = $contentId;        $this->highlighterId = $highlighterId;        $this->situationId = $situationId;        $this->userId = $userId;        $this->positionContent = $positionContent;        $this->name = $name;        $this->path = $path;        /** Verifico o tipo de operação */        if ($this->contentFileId === 0)        {            /** Consulta SQL */            $this->sql = 'INSERT INTO CONTENTS_FILES(content_file_id,                                                     content_id,                                                     highlighter_id,                                                     situation_id,                                                     user_id,                                                     position_content,                                                     name,                                                     path)                                       VALUES(:contentFileId,                                              :contentId,                                              :highlighterId,                                              :situationId,                                              :userId,                                              :positionContent,                                              :name,                                              :path);';        }        else        {            /** Consulta SQL */            $this->sql = 'UPDATE CONTENTS_FILES SET                           content_id = :contentId,                          highlighter_id = :highlighterId,                          situation_id = :situationId,                          user_id = :userId,                          position_content = :positionContent,                          name = :name,                          path = :path,                          WHERE content_file_id = :contentFileId';        }        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':contentFileId', $this->contentFileId);        $this->stmt->bindParam(':contentId', $this->contentId);        $this->stmt->bindParam(':highlighterId', $this->highlighterId);        $this->stmt->bindParam(':situationId', $this->situationId);        $this->stmt->bindParam(':userId', $this->userId);        $this->stmt->bindParam(':positionContent', $this->positionContent);        $this->stmt->bindParam(':name', $this->name);        $this->stmt->bindParam(':path', $this->path);        /** Executo o SQL */        return $this->stmt->execute();    }    /** Consulta de um registro especifico */    public function Get(int $contentFileId)    {        /** Parâmetros de Entrada */        $this->contentFileId = $contentFileId;        /** Consulta SQL */        $this->sql = 'SELECT * FROM CONTENTS_FILES WHERE content_file_id = :contentFileId;';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':contentFileId', $this->contentFileId);        /** Executo o SQL */        $this->stmt->execute();        /** Retorno o resultado */        return $this->stmt->fetchObject();    }    /** Remoção de um registro especifico */    public function Delete(int $contentFileId): bool    {        /** Parâmetros de Entrada */        $this->contentFileId = $contentFileId;        /** Consulta SQL */        $this->sql = 'DELETE FROM CONTENTS_FILES WHERE content_file_id = :contentFileId;';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':contentFileId', $this->contentFileId);        /** Executo o SQL */        return $this->stmt->execute();    }    /** Listagem de todos os registros */    public function All(int $contentId)    {        /** Parâmetros de Entrada */        $this->contentId = $contentId;        /** Consulta SQL */        $this->sql = 'SELECT                      cf.content_file_id,                      cf.content_id,                      cf.path,                      cf.name,                      h.description                      FROM CONTENTS_FILES CF                      JOIN HIGHLIGHTERS H ON cf.highlighter_id = h.highlighter_id                        WHERE content_id = :contentId';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':contentId', $this->contentId);        /** Executo o SQL */        $this->stmt->execute();        /** Retorno o resultado */        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);    }    /** Fecha uma conexão aberta anteriormente com o banco de dados */    function __destruct()    {        $this->connection = null;    }}