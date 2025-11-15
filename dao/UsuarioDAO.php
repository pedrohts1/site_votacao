<?php
// DAO - Data Access Object para Usuario
class UsuarioDAO {
    private $conn;
    private $table_name = "usuarios";

    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();

        if (!$this->conn) {
            throw new Exception("Não foi possível conectar ao banco de dados");
        }
    }

    // CREATE - Criar novo usuario
    public function create($usuario) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nome, email, senha) 
                  VALUES (:nome, :email, :senha)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $usuario->getNome());
        $stmt->bindParam(':email', $usuario->getEmail());
        $stmt->bindParam(':senha', $usuario->getSenha());

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // READ - Ler usuario por ID
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $usuario = new Usuario();
            $usuario->setId($row['id']);
            $usuario->setNome($row['nome']);
            $usuario->setEmail($row['email']);
            $usuario->setSenha($row['senha']);
            return $usuario;
        }
        return null;
    }

    // READ - Ler usuario por email
    public function readByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $usuario = new Usuario();
            $usuario->setId($row['id']);
            $usuario->setNome($row['nome']);
            $usuario->setEmail($row['email']);
            $usuario->setSenha($row['senha']);
            return $usuario;
        }
        return null;
    }
}
?>