<?php require_once 'views/layout/header.php'; ?>

<div class="container">
    <h1>Registrar</h1>

    <form method="POST" action="/site_votacao/usuario/store" class="form">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="/site_votacao/usuario/login" class="btn btn-secondary">Já tenho uma conta</a>
        </div>
    </form>
</div>

<?php require_once 'views/layout/footer.php'; ?>