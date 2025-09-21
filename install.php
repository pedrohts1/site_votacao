<?php
// Página de instalação/configuração do sistema
session_start();
require_once 'config/database.php';

$database = new Database();
$connectionTest = $database->testConnection();
$tableTest = $database->checkTables();

$allGood = $connectionTest['success'] && $tableTest['success'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalação - Sistema de Votação</title>
    <link rel="stylesheet" href="/site_votacao/assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1>Sistema de Votação - Instalação</h1>
            </div>
        </nav>
    </header>
    
    <main>
        <div class="container">
            <div class="hero">
                <h1>Configuração do Sistema</h1>
                <p>Verifique se o sistema está configurado corretamente</p>
            </div>
            
            <div class="install-steps">
                <div class="step <?php echo $connectionTest['success'] ? 'success' : 'error'; ?>">
                    <h3>1. Conexão com Banco de Dados</h3>
                    <p><?php echo $connectionTest['message']; ?></p>
                </div>
                
                <div class="step <?php echo $tableTest['success'] ? 'success' : 'error'; ?>">
                    <h3>2. Estrutura do Banco</h3>
                    <p><?php echo $tableTest['message']; ?></p>
                </div>
                
                <?php if (!$tableTest['success']): ?>
                <div class="step info">
                    <h3>3. Próximos Passos</h3>
                    <p>Para configurar o banco de dados:</p>
                    <ol>
                        <li>Abra o phpMyAdmin ou cliente MySQL</li>
                        <li>Execute o script <code>database.sql</code> que está na raiz do projeto</li>
                        <li>Ou copie e cole o seguinte SQL:</li>
                    </ol>
                    <textarea readonly style="width: 100%; height: 150px; font-family: monospace;">
CREATE DATABASE IF NOT EXISTS site_votacao;
USE site_votacao;

CREATE TABLE IF NOT EXISTS votacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    opcao VARCHAR(50) NOT NULL,
    votante_nome VARCHAR(100) NOT NULL,
    votante_email VARCHAR(100) NOT NULL,
    data_voto TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
                    </textarea>
                </div>
                <?php endif; ?>
                
                <?php if ($allGood): ?>
                <div class="step success">
                    <h3>✅ Sistema Pronto!</h3>
                    <p>Tudo configurado corretamente. Você pode começar a usar o sistema.</p>
                    <a href="/site_votacao/" class="btn btn-primary">Ir para o Sistema</a>
                </div>
                <?php else: ?>
                <div class="step error">
                    <h3>⚠️ Configuração Necessária</h3>
                    <p>Corrija os problemas acima antes de usar o sistema.</p>
                    <button onclick="location.reload()" class="btn btn-secondary">Verificar Novamente</button>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="config-info">
                <h3>Informações de Configuração</h3>
                <p><strong>Host:</strong> localhost</p>
                <p><strong>Banco:</strong> site_votacao</p>
                <p><strong>Usuário:</strong> root</p>
                <p><strong>Senha:</strong> (vazia)</p>
                <p><em>Para alterar essas configurações, edite o arquivo config/database.php</em></p>
            </div>
        </div>
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Sistema de Votação. Desenvolvido com PHP e MVC.</p>
        </div>
    </footer>
</body>
</html>
