<?php
// DAO - Data Access Object para Votacao
class VotacaoDAO {
    private $conn;
    private $table_name = "votacoes";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        
        if (!$this->conn) {
            throw new Exception("Não foi possível conectar ao banco de dados");
        }
    }
    
    // CREATE - Criar nova votação
    public function create($votacao) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (opcao, votante_nome, votante_email, data_voto) 
                  VALUES (:opcao, :votante_nome, :votante_email, :data_voto)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':opcao', $votacao->getOpcao());
        $stmt->bindParam(':votante_nome', $votacao->getVotanteNome());
        $stmt->bindParam(':votante_email', $votacao->getVotanteEmail());
        $stmt->bindParam(':data_voto', $votacao->getDataVoto());
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // READ - Ler votação por ID
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $votacao = new Votacao();
            $votacao->setId($row['id']);
            $votacao->setOpcao($row['opcao']);
            $votacao->setVotanteNome($row['votante_nome']);
            $votacao->setVotanteEmail($row['votante_email']);
            $votacao->setDataVoto($row['data_voto']);
            return $votacao;
        }
        return null;
    }
    
    // READ ALL - Ler todas as votações
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY data_voto DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $votacoes = array();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $votacao = new Votacao();
            $votacao->setId($row['id']);
            $votacao->setOpcao($row['opcao']);
            $votacao->setVotanteNome($row['votante_nome']);
            $votacao->setVotanteEmail($row['votante_email']);
            $votacao->setDataVoto($row['data_voto']);
            $votacoes[] = $votacao;
        }
        
        return $votacoes;
    }
    
    // UPDATE - Atualizar votação
    public function update($votacao) {
        $query = "UPDATE " . $this->table_name . " 
                  SET opcao = :opcao, votante_nome = :votante_nome, 
                      votante_email = :votante_email 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':opcao', $votacao->getOpcao());
        $stmt->bindParam(':votante_nome', $votacao->getVotanteNome());
        $stmt->bindParam(':votante_email', $votacao->getVotanteEmail());
        $stmt->bindParam(':id', $votacao->getId());
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // DELETE - Deletar votação
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Contar votos por opção
    public function contarVotosPorOpcao() {
        $query = "SELECT opcao, COUNT(*) as total FROM " . $this->table_name . " GROUP BY opcao";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $resultados = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultados[$row['opcao']] = $row['total'];
        }
        
        return $resultados;
    }
    
    // Verificar se email já votou
    public function verificarEmailJaVotou($email) {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE votante_email = :email";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    
    // Buscar votações por nome ou email
    public function buscar($termo) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE votante_nome LIKE :termo 
                  OR votante_email LIKE :termo 
                  OR opcao LIKE :termo
                  ORDER BY data_voto DESC";
        
        $stmt = $this->conn->prepare($query);
        $termo = "%" . $termo . "%";
        $stmt->bindParam(':termo', $termo);
        $stmt->execute();
        
        $votacoes = array();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $votacao = new Votacao();
            $votacao->setId($row['id']);
            $votacao->setOpcao($row['opcao']);
            $votacao->setVotanteNome($row['votante_nome']);
            $votacao->setVotanteEmail($row['votante_email']);
            $votacao->setDataVoto($row['data_voto']);
            $votacoes[] = $votacao;
        }
        
        return $votacoes;
    }
}
?>

