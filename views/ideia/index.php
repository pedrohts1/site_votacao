<?php require_once 'views/layout/header.php'; ?>

<div class="container">
    <h1>Gerenciar Ideias</h1>

    <div class="actions">
        <a href="/site_votacao/ideia/create" class="btn btn-primary">Nova Ideia</a>
    </div>

    <div class="search-section">
        <form method="GET" action="/site_votacao/ideia" class="search-form">
            <input type="text" name="busca" placeholder="Buscar por título ou descrição..." 
                   value="<?php echo htmlspecialchars($termo); ?>" class="search-input">
            <button type="submit" class="btn btn-secondary">Buscar</button>
            <?php if (!empty($termo)): ?>
                <a href="/site_votacao/ideia" class="btn btn-outline">Limpar</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="ideias-section">
        <h2>Lista de Ideias</h2>
        <?php if (!empty($ideias)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ideias as $ideia): ?>
                        <tr>
                            <td><?php echo $ideia->getId(); ?></td>
                            <td><?php echo $ideia->getTitulo(); ?></td>
                            <td><?php echo $ideia->getDescricao(); ?></td>
                            <td>
                                <a href="/site_votacao/ideia/read?id=<?php echo $ideia->getId(); ?>" class="btn btn-sm btn-info">Ver</a>
                                <a href="/site_votacao/ideia/update?id=<?php echo $ideia->getId(); ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="/site_votacao/ideia/delete?id=<?php echo $ideia->getId(); ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Tem certeza que deseja deletar esta ideia?')">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhuma ideia encontrada.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
