<?php require_once 'views/layout/header.php'; ?>

<div class="container">
    <h1>Editar Votação</h1>
    
    <form method="POST" action="/site_votacao/votacao/update" class="form">
        <input type="hidden" name="id" value="<?php echo $votacao->getId(); ?>">
        
        <div class="form-group">
            <label for="opcao">Opção:</label>
            <select id="opcao" name="opcao" required>
                <option value="Opção A" <?php echo $votacao->getOpcao() == 'Opção A' ? 'selected' : ''; ?>>Opção A</option>
                <option value="Opção B" <?php echo $votacao->getOpcao() == 'Opção B' ? 'selected' : ''; ?>>Opção B</option>
                <option value="Opção C" <?php echo $votacao->getOpcao() == 'Opção C' ? 'selected' : ''; ?>>Opção C</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="votante_nome">Nome do Votante:</label>
            <input type="text" id="votante_nome" name="votante_nome" value="<?php echo $votacao->getVotanteNome(); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="votante_email">Email do Votante:</label>
            <input type="email" id="votante_email" name="votante_email" value="<?php echo $votacao->getVotanteEmail(); ?>" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Atualizar Votação</button>
            <a href="/site_votacao/votacao" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once 'views/layout/footer.php'; ?>

