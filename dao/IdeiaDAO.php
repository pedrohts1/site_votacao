<?php
// DAO - Data Access Object para Ideia
class IdeiaDAO {
    private $conn;
    private $table_name = "ideias";

    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();

        if (!$this->conn) {
            throw new Exception("Não foi possível conectar ao banco de dados");
        }
    }

    // CREATE - Criar nova ideia
    public function create($ideia) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (titulo, descricao, usuario_id) 
                  VALUES (:titulo, :descricao, :usuario_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':titulo', $ideia->getTitulo());
        $stmt->bindParam(':descricao', $ideia->getDescricao());
        $stmt->bindParam(':usuario_id', $ideia->getUsuarioId());

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // READ - Ler ideia por ID
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $ideia = new Ideia();
            $ideia->setId($row['id']);
            $ideia->setTitulo($row['titulo']);
            $ideia->setDescricao($row['descricao']);
            $ideia->setUsuarioId($row['usuario_id']);
            return $ideia;
        }
        return null;
    }

    // READ ALL - Ler todas as ideias
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $ideias = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ideia = new Ideia();
            $ideia->setId($row['id']);
            $ideia->setTitulo($row['titulo']);
            $ideia->setDescricao($row['descricao']);
            $ideia->setUsuarioId($row['usuario_id']);
            $ideias[] = $ideia;
        }

        return $ideias;
    }

    // UPDATE - Atualizar ideia
    public function update($ideia) {
        $query = "UPDATE " . $this->table_name . " 
                  SET titulo = :titulo, descricao = :descricao, 
                      usuario_id = :usuario_id 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':titulo', $ideia->getTitulo());
        $stmt->bindParam(':descricao', $ideia->getDescricao());
        $stmt->bindParam(':usuario_id', $ideia->getUsuarioId());
        $stmt->bindParam(':id', $ideia->getId());

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE - Deletar ideia
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Buscar ideias por título ou descrição
    public function buscar($termo) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE titulo LIKE :termo 
                  OR descricao LIKE :termo
                  ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);
        $termo = "%" . $termo . "%";
        $stmt->bindParam(':termo', $termo);
        $stmt->execute();

        $ideias = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ideia = new Ideia();
            $ideia->setId($row['id']);
            $ideia->setTitulo($row['titulo']);
            $ideia->setDescricao($row['descricao']);
            $ideia->setUsuarioId($row['usuario_id']);
            $ideias[] = $ideia;
        }

        return $ideias;
    }
}
?>
