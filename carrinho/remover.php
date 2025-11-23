<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();
include("../conexao.php");

header("Content-Type: application/json");

// Se não estiver logado, retorna carrinho vazio
if (!isset($_SESSION['id'])) {
    echo json_encode(["itens" => [], "total" => "0,00", "total_qtd" => 0]);
    exit;
}

$id_usuario = intval($_SESSION['id']);
$id_produto = intval($_GET['id']);

// Remove item
$conexao->query("
    DELETE FROM carrinho 
    WHERE id_usuario = $id_usuario 
    AND id_produto = $id_produto
");

// Agora buscamos dados do carrinho SEM usar include
require("listar.php");
exit;
?>
