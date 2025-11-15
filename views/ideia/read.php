<?php require_once 'views/layout/header.php'; ?>

<div class="container">
    <h1>Detalhes da Ideia</h1>

    <div class="ideia-details">
        <p><strong>ID:</strong> <?php echo $ideia->getId(); ?></p>
        <p><strong>Título:</strong> <?php echo $ideia->getTitulo(); ?></p>
        <p><strong>Descrição:</strong> <?php echo $ideia->getDescricao(); ?></p>
    </div>

    <div class="actions">
        <a href="/site_votacao/ideia/update?id=<?php echo $ideia->getId(); ?>" class="btn btn-warning">Editar</a>
        <a href="/site_votacao/ideia" class="btn btn-secondary">Voltar</a>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
