<?php
echo "<h2>Resultados da Votação</h2>";

// Dados de exemplo (simulando resultados)
$opcoes = array(
    "Opção A" => 15,
    "Opção B" => 25,
    "Opção C" => 10
);

$total = array_sum($opcoes);

echo "<p>Total de votos: $total</p><br>";

foreach ($opcoes as $opcao => $votos) {
    $porcentagem = round(($votos / $total) * 100, 1);
    echo "<p><strong>$opcao:</strong> $votos votos ($porcentagem%)</p>";
}

echo "<br><a href='index.php'>Voltar ao início</a>";
?>
