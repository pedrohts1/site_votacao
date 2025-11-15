<?php require_once 'views/layout/header.php'; ?>

<div class="container">
    <h1>Editar Ideia</h1>

    <form method="POST" action="/site_votacao/ideia/update" class="form">
        <input type="hidden" name="id" value="<?php echo $ideia->getId(); ?>">

        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $ideia->getTitulo(); ?>" required>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" required><?php echo $ideia->getDescricao(); ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Atualizar Ideia</button>
            <a href="/site_votacao/ideia" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once 'views/layout/footer.php'; ?>
