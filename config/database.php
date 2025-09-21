<?php
// Configurações do banco de dados
class Database {
    private $host = 'localhost';
    private $db_name = 'site_votacao';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                )
            );
        } catch(PDOException $exception) {
            // Log do erro (em produção, usar arquivo de log)
            error_log("Erro de conexão com banco: " . $exception->getMessage());
            
            // Mostrar erro amigável para o usuário
            die("Erro: Não foi possível conectar ao banco de dados. Verifique as configurações.");
        }
        
        return $this->conn;
    }
    
    // Método para testar conexão
    public function testConnection() {
        try {
            $conn = $this->getConnection();
            if ($conn) {
                return array('success' => true, 'message' => 'Conexão com banco de dados estabelecida com sucesso!');
            }
        } catch(Exception $e) {
            return array('success' => false, 'message' => 'Erro na conexão: ' . $e->getMessage());
        }
    }
    
    // Método para verificar se as tabelas existem
    public function checkTables() {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->query("SHOW TABLES LIKE 'votacoes'");
            $tableExists = $stmt->rowCount() > 0;
            
            if ($tableExists) {
                return array('success' => true, 'message' => 'Tabela votacoes encontrada!');
            } else {
                return array('success' => false, 'message' => 'Tabela votacoes não encontrada. Execute o script database.sql');
            }
        } catch(Exception $e) {
            return array('success' => false, 'message' => 'Erro ao verificar tabelas: ' . $e->getMessage());
        }
    }
}
?>

