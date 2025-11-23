<?php
error_reporting(0);
ini_set('display_errors', 0);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../conexao.php");

// Se não estiver logado, retorna carrinho vazio
if (!isset($_SESSION['id'])) {
    echo json_encode(["itens" => [], "total" => "0,00", "total_qtd" => 0]);
    exit;
}

$id_usuario = $_SESSION['id'];

$sql = "SELECT c.id_produto, c.quantidade, p.nome, p.preco 
        FROM carrinho c
        JOIN produtos p ON p.id = c.id_produto
        WHERE c.id_usuario = $id_usuario";

$res = $conexao->query($sql);

$itens = [];
$total = 0;

while ($row = $res->fetch_assoc()) {
    $subtotal = $row['preco'] * $row['quantidade'];
    $total += $subtotal;

    $itens[] = [
        "id" => $row['id_produto'],
        "nome" => $row['nome'],
        "preco" => number_format($row['preco'], 2, ',', '.'),
        "qtd" => $row['quantidade']
    ];
}

$total_qtd = $conexao->query("
    SELECT SUM(quantidade) AS total FROM carrinho WHERE id_usuario = $id_usuario
")->fetch_assoc()['total'] ?? 0;

echo json_encode([
    "itens" => $itens,
    "total" => number_format($total, 2, ',', '.'),
    "total_qtd" => intval($total_qtd)
]);
?>
