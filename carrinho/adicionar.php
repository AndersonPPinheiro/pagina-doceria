<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();
include("../conexao.php");

$id_usuario = $_SESSION['id'];
$id_produto = intval($_GET['id']);

// Verificar se já existe item
$check = $conexao->prepare("SELECT quantidade FROM carrinho WHERE id_usuario = ? AND id_produto = ?");
$check->bind_param("ii", $id_usuario, $id_produto);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    // Atualiza quantidade
    $conexao->query("UPDATE carrinho SET quantidade = quantidade + 1 
                     WHERE id_usuario = $id_usuario AND id_produto = $id_produto");
} else {
    // Insere novo item
    $conexao->query("INSERT INTO carrinho (id_usuario, id_produto, quantidade) 
                     VALUES ($id_usuario, $id_produto, 1)");
}

// Quantidade total
$total_qtd = $conexao->query("SELECT SUM(quantidade) AS total FROM carrinho WHERE id_usuario = $id_usuario")
                     ->fetch_assoc()['total'];

echo json_encode([
    "success" => true,
    "total_qtd" => $total_qtd
]);
?>