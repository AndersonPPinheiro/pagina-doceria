<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();
include("../conexao.php");

header("Content-Type: application/json");

if (!isset($_SESSION['id'])) {
    echo json_encode(["itens" => [], "total" => "0,00", "total_qtd" => 0]);
    exit;
}

$id_usuario = intval($_SESSION['id']);
$id_produto = intval($_GET['id']);
$qtd = intval($_GET['qtd']);

// Atualiza quantidade
$conexao->query("
    UPDATE carrinho 
    SET quantidade = quantidade + $qtd 
    WHERE id_usuario = $id_usuario 
    AND id_produto = $id_produto
");

// Remove se quantidade <= 0
$conexao->query("
    DELETE FROM carrinho 
    WHERE quantidade <= 0
    AND id_usuario = $id_usuario
    AND id_produto = $id_produto
");

// Retorna JSON do carrinho atualizado
require("listar.php");
exit;
?>
