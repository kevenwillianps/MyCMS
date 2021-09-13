<?php/** Defino o local onde esta a classe */namespace vendor\model;class Contents{    /** Declaro as variavéis da classe */    private $connection = null;    private $sql = null;    private $stmt = null;    private $contentId = null;    private $contentCategoryId = null;    private $highlighterId = null;    private $situationId = null;    private $userId = null;    private $positionContent = null;    private $positionMenu = null;    private $url = null;    private $title = null;    private $titleMenu = null;    private $description = null;    private $contentResume = null;    private $contentComplete = null;    private $visited = null;    private $dateStart = null;    private $dateClosing = null;    private $history = null;    /** Construtor da classe */    function __construct()    {        /** Cria o objeto de conexão com o banco de dados */        $this->connection = new MySql();    }    /** Salvo ou atualizo um registro */    public function Save(int $contentId, int $contentCategoryId, int $highlighterId, int $situationId, int $userId, int $positionContent, int $positionMenu, string $url, string $title, string $titleMenu, string $description, string $contentResume, string $contentComplete, int $visited, string $dateStart, string $dateClosing, string $history): bool    {        /** Parâmetros de Entrada */        $this->contentId = $contentId;        $this->contentCategoryId = $contentCategoryId;        $this->highlighterId = $highlighterId;        $this->situationId = $situationId;        $this->userId = $userId;        $this->positionContent = $positionContent;        $this->positionMenu = $positionMenu;        $this->url = $url;        $this->title = $title;        $this->titleMenu = $titleMenu;        $this->description = $description;        $this->contentResume = $contentResume;        $this->contentComplete = $contentComplete;        $this->visited = $visited;        $this->dateStart = $dateStart;        $this->dateClosing = $dateClosing;        $this->history = $history;        /** Verifico o tipo de operação */        if ($this->contentId === 0)        {            /** Consulta SQL */            $this->sql = 'INSERT INTO CONTENTS(content_id,                                               content_category_id,                                               highlighter_id,                                               situation_id,                                               user_id,                                               position_content,                                               position_menu,                                               url,                                               title,                                               title_menu,                                               description,                                               content_resume,                                               content_complete,                                               visited,                                               date_start,                                               date_closing,                                               history)                                       VALUES(:contentId,                                              :contentCategoryId,                                              :highlighterId,                                              :situationId,                                              :userId,                                              :positionContent,                                              :positionMenu,                                              :url,                                              :title,                                              :titleMenu,                                              :description,                                              :contentResume,                                              :contentComplete,                                              :visited,                                              :dateStart,                                              :dateClosing,                                              :history);';        }        else        {            /** Consulta SQL */            $this->sql = 'UPDATE CONTENTS SET                           content_category_id = :contentCategoryId,                          highlighter_id = :highlighterId,                          situation_id = :situationId,                          user_id = :userId,                          position_content = :positionContent,                          position_menu = :positionMenu,                          url = :url,                          title = :title,                          title_menu = :titleMenu,                          description = :description,                          content_resume = :contentResume,                          content_complete = :contentComplete,                          visited = :visited,                          date_start = :dateStart,                          date_closing = :dateClosing,                          history = :history                          WHERE content_id = :contentId';        }        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':contentId', $this->contentId);        $this->stmt->bindParam(':contentCategoryId', $this->contentCategoryId);        $this->stmt->bindParam(':highlighterId', $this->highlighterId);        $this->stmt->bindParam(':situationId', $this->situationId);        $this->stmt->bindParam(':userId', $this->userId);        $this->stmt->bindParam(':positionContent', $this->positionContent);        $this->stmt->bindParam(':positionMenu', $this->positionMenu);        $this->stmt->bindParam(':url', $this->url);        $this->stmt->bindParam(':title', $this->title);        $this->stmt->bindParam(':titleMenu', $this->titleMenu);        $this->stmt->bindParam(':description', $this->description);        $this->stmt->bindParam(':contentResume', $this->contentResume);        $this->stmt->bindParam(':contentComplete', $this->contentComplete);        $this->stmt->bindParam(':visited', $this->visited);        $this->stmt->bindParam(':dateStart', $this->dateStart);        $this->stmt->bindParam(':dateClosing', $this->dateClosing);        $this->stmt->bindParam(':history', $this->history);        /** Executo o SQL */        return $this->stmt->execute();    }    /** Consulta de um registro especifico */    public function Get(int $contentId)    {        /** Parâmetros de Entrada */        $this->contentId = $contentId;        /** Consulta SQL */        $this->sql = 'SELECT * FROM CONTENTS WHERE content_id = :contentId;';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':contentId', $this->contentId);        /** Executo o SQL */        $this->stmt->execute();        /** Retorno o resultado */        return $this->stmt->fetchObject();    }    /** Remoção de um registro especifico */    public function Delete(int $contentId): bool    {        /** Parâmetros de Entrada */        $this->contentId = $contentId;        /** Consulta SQL */        $this->sql = 'DELETE FROM CONTENTS WHERE content_id = :contentId;';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Preenchimento dos parâmetros */        $this->stmt->bindParam(':contentId', $this->contentId);        /** Executo o SQL */        return $this->stmt->execute();    }    /** Listagem de todos os registros */    public function All()    {        /** Consulta SQL */        $this->sql = 'SELECT                      h.description,                      c.content_id,                      c.title,                      c.date                      FROM CONTENTS C                      JOIN HIGHLIGHTERS H ON C.HIGHLIGHTER_ID = H.HIGHLIGHTER_ID;';        /** Preparo o SQL para execução */        $this->stmt = $this->connection->connect()->prepare($this->sql);        /** Executo o SQL */        $this->stmt->execute();        /** Retorno o resultado */        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);    }    /** Fecha uma conexão aberta anteriormente com o banco de dados */    function __destruct()    {        $this->connection = null;    }}