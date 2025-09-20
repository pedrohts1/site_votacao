<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Votação</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
// Arquivo principal - página inicial
echo "<h1>Sistema de Votação</h1>";
echo "<p>Bem-vindo ao sistema de votação online!</p>";

// Verificar se o usuário quer votar
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
    
    if ($acao == 'votar') {
        include 'votar.php';
    } elseif ($acao == 'resultados') {
        include 'resultados.php';
    }
} else {
    // Mostrar menu principal
    echo "<h2>Escolha uma opção:</h2>";
    echo "<a href='?acao=votar'>Votar</a> | ";
    echo "<a href='?acao=resultados'>Ver Resultados</a>";
}
?>
</body>
</html>
