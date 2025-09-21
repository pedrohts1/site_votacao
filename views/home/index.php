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
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>

