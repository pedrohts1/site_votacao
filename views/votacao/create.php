<?php require_once 'views/layout/header.php'; ?>

<div class="container">
    <h1>Nova Votação</h1>
    
    <form method="POST" action="/site_votacao/votacao/store" class="form">
        <div class="form-group">
            <label for="opcao">Opção:</label>
            <select id="opcao" name="opcao" required>
                <option value="">Selecione uma opção</option>
                <option value="Opção A">Opção A</option>
                <option value="Opção B">Opção B</option>
                <option value="Opção C">Opção C</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="votante_nome">Nome do Votante:</label>
            <input type="text" id="votante_nome" name="votante_nome" required>
        </div>
        
        <div class="form-group">
            <label for="votante_email">Email do Votante:</label>
            <input type="email" id="votante_email" name="votante_email" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Registrar Voto</button>
            <a href="/site_votacao/votacao" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once 'views/layout/footer.php'; ?>

