<?php
session_start();
include("../conexao.php");

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$id_usuario = $_SESSION['id'];
$pagamento = $_POST['pagamento'] ?? 'pix';

// Buscar itens do carrinho
$sql = "SELECT c.id_produto, c.quantidade, p.preco 
        FROM carrinho c
        JOIN produtos p ON p.id = c.id_produto
        WHERE c.id_usuario = $id_usuario";

$res = $conexao->query($sql);

$total = 0;
$itens = [];

while ($row = $res->fetch_assoc()) {
    $total += $row['preco'] * $row['quantidade'];
    $itens[] = $row;
}

if (empty($itens)) {
    header("Location: ../menu.php?erro=carrinho_vazio");
    exit;
}

// Criar pedido
$conexao->query("INSERT INTO pedidos (id_usuario, total, pagamento)
    VALUES ($id_usuario, $total, '$pagamento')");

$id_pedido = $conexao->insert_id;

// Inserir itens
foreach ($itens as $i) {
    $p = $i['preco'];
    $q = $i['quantidade'];
    $id_prod = $i['id_produto'];

    $conexao->query("INSERT INTO itens_pedido (id_pedido, id_produto, quantidade, preco)
        VALUES ($id_pedido, $id_prod, $q, $p)
    ");
}

// Limpar carrinho
$conexao->query("DELETE FROM carrinho WHERE id_usuario = $id_usuario");

// Redirecionar
header("Location: pedido_sucesso.php?id=$id_pedido");
exit;
?>
