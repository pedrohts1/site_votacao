<?php
// Configurações do banco de dados
class Database {
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $db_name = 'site_votacao';
    private $username = 'root';
    private $password = '';

    private function __construct() {
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
            error_log("Erro de conexão com banco: " . $exception->getMessage());
            die("Erro: Não foi possível conectar ao banco de dados. Verifique as configurações.");
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
    
    // Método para verificar se as tabelas existem
    public function checkTables() {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->query("SHOW TABLES LIKE 'usuarios'");
            $tableExists = $stmt->rowCount() > 0;
            
            if ($tableExists) {
                return array('success' => true, 'message' => 'Tabela usuarios encontrada!');
            } else {
                return array('success' => false, 'message' => 'Tabela usuarios não encontrada. Execute o script database.sql');
            }
        } catch(Exception $e) {
            return array('success' => false, 'message' => 'Erro ao verificar tabelas: ' . $e->getMessage());
        }
    }
}
?>

