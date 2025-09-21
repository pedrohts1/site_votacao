<?php require_once 'views/layout/header.php'; ?>

<div class="container">
    <div class="hero">
        <h1><?php echo $title; ?></h1>
        <p><?php echo $message; ?></p>
        <a href="/site_votacao/votacao" class="btn btn-primary">Ver Votações</a>
    </div>
    
    <div class="features">
        <div class="feature">
            <h3>CRUD Completo</h3>
            <p>Create, Read, Update e Delete de votações</p>
        </div>
        <div class="feature">
            <h3>Padrão MVC</h3>
            <p>Arquitetura Model-View-Controller</p>
        </div>
        <div class="feature">
            <h3>DAO e Service</h3>
            <p>Camadas de acesso a dados e regras de negócio</p>
        </div>
        <div class="feature">
            <h3>Banco MySQL</h3>
            <p>Conexão robusta com banco de dados</p>
        </div>
        <div class="feature">
            <h3>Estatísticas</h3>
            <p>Relatórios e análises em tempo real</p>
        </div>
        <div class="feature">
            <h3>Validações</h3>
            <p>Controle de dados e votos duplicados</p>
        </div>
    </div>
    
    <div class="quick-actions">
        <h2>Acesso Rápido</h2>
        <div class="action-buttons">
            <a href="/site_votacao/votacao" class="btn btn-primary">Gerenciar Votações</a>
            <a href="/site_votacao/stats" class="btn btn-secondary">Ver Estatísticas</a>
            <a href="/site_votacao/install.php" class="btn btn-outline">Verificar Sistema</a>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>

