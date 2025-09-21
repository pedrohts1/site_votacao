<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Sistema de Votação'; ?></title>
    <link rel="stylesheet" href="/site_votacao/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🗳️</text></svg>">
    <script src="/site_votacao/assets/js/script.js" defer></script>
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1>Sistema de Votação</h1>
                <ul>
                    <li><a href="/site_votacao/">Home</a></li>
                    <li><a href="/site_votacao/votacao">Votações</a></li>
                    <li><a href="/site_votacao/stats">Estatísticas</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
        <?php endif; ?>

