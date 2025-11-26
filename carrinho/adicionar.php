<?php
session_start();
include("../check/conexao.php");

$id_usuario = $_SESSION['id'];
$id_produto = intval($_GET['id']);

$check = $conexao->prepare("SELECT quantidade FROM carrinho WHERE id_usuario = ? AND id_produto = ?");
$check->bind_param("ii", $id_usuario, $id_produto);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    $conexao->query("UPDATE carrinho SET quantidade = quantidade + 1 
                     WHERE id_usuario = $id_usuario AND id_produto = $id_produto");
} else {
    $conexao->query("INSERT INTO carrinho (id_usuario, id_produto, quantidade) 
                     VALUES ($id_usuario, $id_produto, 1)");
}

$total_qtd = $conexao->query("SELECT SUM(quantidade) AS total FROM carrinho WHERE id_usuario = $id_usuario")
                     ->fetch_assoc()['total'];

echo json_encode([
    "success" => true,
    "total_qtd" => $total_qtd
]);
?>