<?php
// Script para configurar automaticamente o banco de dados
require_once 'config/database.php';

echo "<h2>Configuração Automática do Banco de Dados</h2>";

try {
    // Conectar sem especificar o banco para criar se necessário
    $pdo = new PDO("mysql:host=localhost;charset=utf8", "root", "", array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    
    // Criar banco de dados se não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS site_votacao CHARACTER SET utf8 COLLATE utf8_general_ci");
    echo "<p style='color: green;'>✅ Banco de dados 'site_votacao' criado/verificado com sucesso!</p>";
    
    // Selecionar o banco
    $pdo->exec("USE site_votacao");
    
    // Criar tabela votacoes
    $sql = "CREATE TABLE IF NOT EXISTS votacoes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        opcao VARCHAR(50) NOT NULL,
        votante_nome VARCHAR(100) NOT NULL,
        votante_email VARCHAR(100) NOT NULL,
        data_voto TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    
    $pdo->exec($sql);
    echo "<p style='color: green;'>✅ Tabela 'votacoes' criada/verificada com sucesso!</p>";
    
    // Verificar se a tabela está vazia e inserir dados de exemplo
    $stmt = $pdo->query("SELECT COUNT(*) FROM votacoes");
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        // Inserir dados de exemplo
        $exemplos = [
            ['Opção A', 'João Silva', 'joao@email.com'],
            ['Opção B', 'Maria Santos', 'maria@email.com'],
            ['Opção C', 'Pedro Costa', 'pedro@email.com'],
            ['Opção A', 'Ana Oliveira', 'ana@email.com'],
            ['Opção B', 'Carlos Lima', 'carlos@email.com']
        ];
        
        $stmt = $pdo->prepare("INSERT INTO votacoes (opcao, votante_nome, votante_email) VALUES (?, ?, ?)");
        
        foreach ($exemplos as $exemplo) {
            $stmt->execute($exemplo);
        }
        
        echo "<p style='color: green;'>✅ Dados de exemplo inseridos com sucesso!</p>";
    } else {
        echo "<p style='color: blue;'>ℹ️ Tabela já possui dados. Nenhum exemplo foi inserido.</p>";
    }
    
    // Testar a conexão usando a classe Database
    $database = new Database();
    $connectionTest = $database->testConnection();
    
    if ($connectionTest['success']) {
        echo "<p style='color: green;'>✅ Conexão testada com sucesso!</p>";
        echo "<p><strong>Sistema configurado e pronto para uso!</strong></p>";
        echo "<p><a href='/site_votacao/'>Ir para o Sistema</a> | <a href='/site_votacao/install.php'>Página de Instalação</a></p>";
    } else {
        echo "<p style='color: red;'>❌ Erro ao testar conexão: " . $connectionTest['message'] . "</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Erro: " . $e->getMessage() . "</p>";
    echo "<p>Verifique se o MySQL está rodando e se as credenciais estão corretas.</p>";
}
?>
