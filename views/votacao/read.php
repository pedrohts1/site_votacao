<?php require_once 'views/layout/header.php'; ?>

<div class="container">
    <h1>Detalhes da Votação</h1>
    
    <div class="votacao-details">
        <p><strong>ID:</strong> <?php echo $votacao->getId(); ?></p>
        <p><strong>Opção:</strong> <?php echo $votacao->getOpcao(); ?></p>
        <p><strong>Votante:</strong> <?php echo $votacao->getVotanteNome(); ?></p>
        <p><strong>Email:</strong> <?php echo $votacao->getVotanteEmail(); ?></p>
        <p><strong>Data do Voto:</strong> <?php echo date('d/m/Y H:i:s', strtotime($votacao->getDataVoto())); ?></p>
    </div>
    
    <div class="actions">
        <a href="/site_votacao/votacao/update?id=<?php echo $votacao->getId(); ?>" class="btn btn-warning">Editar</a>
        <a href="/site_votacao/votacao" class="btn btn-secondary">Voltar</a>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>

