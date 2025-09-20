<?php
echo "<h2>Página de Votação</h2>";

// Verificar se o formulário foi enviado
if ($_POST) {
    $opcao = $_POST['opcao'];
    $nome = $_POST['nome'];
    
    echo "<p>Obrigado $nome! Seu voto na opção '$opcao' foi registrado.</p>";
    echo "<a href='index.php'>Voltar ao início</a>";
} else {
    // Mostrar formulário de votação
    ?>
    <form method="POST">
        <p>Seu nome: <input type="text" name="nome" required></p>
        
        <p>Escolha uma opção:</p>
        <input type="radio" name="opcao" value="Opção A" required> Opção A<br>
        <input type="radio" name="opcao" value="Opção B" required> Opção B<br>
        <input type="radio" name="opcao" value="Opção C" required> Opção C<br><br>
        
        <input type="submit" value="Votar">
    </form>
    
    <a href="index.php">Voltar</a>
    <?php
}
?>
