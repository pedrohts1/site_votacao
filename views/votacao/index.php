<?php require_once 'views/layout/header.php'; ?>

<div class="container">
    <h1>Gerenciar Votações</h1>
    
    <div class="actions">
        <a href="/site_votacao/votacao/create" class="btn btn-primary">Nova Votação</a>
    </div>
    
    <div class="search-section">
        <form method="GET" action="/site_votacao/votacao" class="search-form">
            <input type="text" name="busca" placeholder="Buscar por nome, email ou opção..." 
                   value="<?php echo htmlspecialchars($termo); ?>" class="search-input">
            <button type="submit" class="btn btn-secondary">Buscar</button>
            <?php if (!empty($termo)): ?>
                <a href="/site_votacao/votacao" class="btn btn-outline">Limpar</a>
            <?php endif; ?>
        </form>
    </div>
    
    <div class="results-section">
        <h2>Resultados Atuais</h2>
        <?php if ($resultados['total'] > 0): ?>
            <p>Total de votos: <?php echo $resultados['total']; ?></p>
            <div class="results-grid">
                <?php foreach ($resultados['resultados'] as $opcao => $dados): ?>
                    <div class="result-item">
                        <h3><?php echo $opcao; ?></h3>
                        <div class="progress-bar">
                            <div class="progress" style="width: <?php echo $dados['percentual']; ?>%"></div>
                        </div>
                        <span class="percentage"><?php echo $dados['percentual']; ?>%</span>
                        <span class="votes"><?php echo $dados['votos']; ?> votos</span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Nenhum voto registrado ainda.</p>
        <?php endif; ?>
    </div>
    
    <div class="votacoes-section">
        <h2>Lista de Votações</h2>
        <?php if (!empty($votacoes)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Opção</th>
                        <th>Votante</th>
                        <th>Email</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($votacoes as $votacao): ?>
                        <tr>
                            <td><?php echo $votacao->getId(); ?></td>
                            <td><?php echo $votacao->getOpcao(); ?></td>
                            <td><?php echo $votacao->getVotanteNome(); ?></td>
                            <td><?php echo $votacao->getVotanteEmail(); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($votacao->getDataVoto())); ?></td>
                            <td>
                                <a href="/site_votacao/votacao/read?id=<?php echo $votacao->getId(); ?>" class="btn btn-sm btn-info">Ver</a>
                                <a href="/site_votacao/votacao/update?id=<?php echo $votacao->getId(); ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="/site_votacao/votacao/delete?id=<?php echo $votacao->getId(); ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Tem certeza que deseja deletar esta votação?')">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhuma votação encontrada.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>

