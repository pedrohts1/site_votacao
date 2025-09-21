<?php require_once 'views/layout/header.php'; ?>

<div class="container">
    <h1>Estatísticas Detalhadas</h1>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total de Votos</h3>
            <div class="stat-number"><?php echo $stats['total']; ?></div>
        </div>
        
        <div class="stat-card">
            <h3>Votos Hoje</h3>
            <div class="stat-number"><?php echo $stats['votosHoje']; ?></div>
        </div>
        
        <div class="stat-card">
            <h3>Média por Dia</h3>
            <div class="stat-number"><?php echo $stats['mediaPorDia']; ?></div>
        </div>
    </div>
    
    <div class="results-section">
        <h2>Resultados por Opção</h2>
        <?php if ($resultados['total'] > 0): ?>
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
        <h2>Últimas Votações</h2>
        <?php if (!empty($votacoes)): ?>
            <div class="votacoes-list">
                <?php foreach (array_slice($votacoes, 0, 10) as $votacao): ?>
                    <div class="votacao-item">
                        <div class="votacao-info">
                            <strong><?php echo $votacao->getVotanteNome(); ?></strong>
                            <span class="opcao"><?php echo $votacao->getOpcao(); ?></span>
                        </div>
                        <div class="votacao-date">
                            <?php echo date('d/m/Y H:i', strtotime($votacao->getDataVoto())); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Nenhuma votação encontrada.</p>
        <?php endif; ?>
    </div>
    
    <div class="actions">
        <a href="/site_votacao/votacao" class="btn btn-primary">Gerenciar Votações</a>
        <a href="/site_votacao/" class="btn btn-secondary">Voltar ao Início</a>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
